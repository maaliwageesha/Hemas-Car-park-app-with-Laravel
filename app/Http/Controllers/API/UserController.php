<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;
// use Intervention\Image\ImageManagerStatic as Image;
use Intervention\Image\Facades\Image;
use App\Http\Resources\Users as UserResource;
use App\Http\Resources\UsersCollection;
use App\User;

class UserController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(Gate::allows('isSuperAdmin') || Gate::allows('isAdmin')) {
            $users = User::latest()->paginate(10);
            return new UsersCollection($users);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users',
            'password' => 'required|string|min:5',
            'type' => 'required'
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'type' => $request->type,
            'bio' => $request->bio,
            'password' => Hash::make($request->password)
        ]);

        $accessToken = $user->createToken('authToken')->accessToken;

        return ['user' => $user, 'access_token' => $accessToken];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function profile()
    {
        return auth('api')->user();
    }

    public function updateProfile(Request $request)
    {
        $user = auth('api')->user();

        $this->validate($request, [
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users,email,'.$user->id,
            'password' => 'sometimes|min:6'
        ]);

        $currentPhoto = $user->photo;
        if ($request->photo != $currentPhoto) {
            $name = uniqid(time()) . '.' . explode('/', explode(';', $request->photo)[0])[1];
            Image::make($request->photo)->resize(500,500)->save(public_path('img/profile/').$name);
            $request->merge(['photo' => $name]);

            if ($currentPhoto != 'profile.png') {
                $old_photo = public_path('img/profile/').$currentPhoto;
                if(file_exists($old_photo)) {
                    @unlink($old_photo);
                }
            }
        }

        if ($request->password) {
            $request->merge(['password' => Hash::make($request->password)]);
        }

        $user->update($request->all());
        return $request->all();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user_data = $this->validate($request, [
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users,email,' . $user->id,
            'type' => 'required'
        ]);

        // $user->update($request->all());
        $user->update($user_data);
        return ['message' => 'success'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('isSuperAdmin');
        $user = User::findOrFail($id);
        $user->delete();
        return ['message' => 'User deleted successfully!'];
    }

    public function search(Request $request)
    {
        if ($search = $request->get('q')) {
            $users = User::where(function($query) use ($search) {
                $query->where('name', 'LIKE', "%$search%")
                ->orWhere('email', 'LIKE', "%$search%")
                ->orWhere('type', 'LIKE', "%$search%");
            })->paginate(10);
        } else {
            $users = User::latest()->paginate(10);
        }
        return $users;
    }
}
