<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Mail\ReservationMail;
use App\Staff;
use App\Parking;
use App\Reservation;
use App\Slot;
use App\Type;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DB::table('staff_members')->where('type_id', '!=', 4)->latest()->paginate(10);
        // return Staff::where('type_id', 4)->latest()->paginate(10);
    }

    public function regular()
    {
        return Staff::where('type_id', 4)->latest()->paginate(10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

         $validated_data = $this->validate($request, [
            'name' => 'required',
            'email' => 'email|required|max:155|unique:staff_members',
            'phone_number' => 'required|max:10|unique:staff_members',
            'vehicle_number' => 'required|max:10',
            'type_id' => '',
            'reservation_code' => '',
            'type_name' => ''
        ]);
        $type = Type::findOrFail($request->type_id);
        $res_code = 'S-' .rand(1000, 9999);
        $validated_data = array_merge($validated_data, ['reservation_code' => $res_code, 'type_name' => $type->type_name]);

        Mail::to($validated_data['email'])->send(new ReservationMail($validated_data));
        return Staff::create($validated_data);
    }

    public function store_reg(Request $request)
    {

         $validated_data = $this->validate($request, [
            'name' => 'required',
            'email' => 'email|required|max:155|unique:staff_members',
            'phone_number' => 'required|max:10|unique:staff_members',
            'vehicle_number' => 'required|max:10',
            'type_id' => '',
            'reservation_code' => '',
            'type_name' => ''
        ]);
        $type = Type::findOrFail($request->type_id);
        $res_code = 'V-' .rand(1000, 9999);
        $validated_data = array_merge($validated_data, ['reservation_code' => $res_code, 'type_name' => $type->type_name]);

        Mail::to($validated_data['email'])->send(new ReservationMail($validated_data));
        return Staff::create($validated_data);
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $staff = Staff::findOrFail($id);

         $validated_data = $this->validate($request, [
            'name' => 'required',
            'email' => 'email|required|max:155|unique:staff_members,email,'.$staff->id,
            'phone_number' => 'required|max:10|unique:staff_members,phone_number,'.$staff->id,
            'vehicle_number' => 'required|max:10',
            'type_id' => '',
            'type_name' => '',
        ]);

        $type = Type::findOrFail($request->type_id);
        $validated_data = array_merge($validated_data, ['type_name' => $type->type_name]);
        $staff->update($validated_data);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $this->authorize('isSuperAdmin');
        $staff = Staff::findOrFail($id);
        $staff->delete();
        return ['message' => 'Staff Member deleted successfully!'];
    }

    public function check(Request $request)
    {
        $staff = Staff::where('reservation_code', $request->reservation_code)->get();
        if ($staff->isEmpty()) {
            return ['status' => 400, 'message' => 'Invalid Code!'];
        }

        $results = Parking::where('status_id', 1)->where(function ($query) use ($request){
            $query->where('reservation_code', $request->reservation_code);
        })->get();

        if (!$results->isEmpty()) {
            return response()->json(['status' => 400, 'message' => 'You have already parked your vehicle at Block ' . $results->first()->slot_id]);
        }

        $results2 = Reservation::where('status_id', 1)->where(function ($query) use ($request){
            $query->where('reservation_code', $request->reservation_code);
        })->get();

        if (!$results2->isEmpty()) {
            return response()->json(['status' => 400, 'message' => 'You have already reserved Block ' . $results2->first()->slot_id]);
        }

         $data = [
            'slot_id' => $request->slot_id,
            'name' => $staff->first()->name,
            'phone_number' => $staff->first()->phone_number,
            'email' => $staff->first()->email,
            'status_id' => 1,
            'reservation_code' => $request->reservation_code,
        ];

        $slot = Slot::findOrFail($request->slot_id);
        $slot->status_id = 1;
        $slot->update();
        Parking::create($data);
        return ['status' => 200, 'message' => 'Success'];
    }

    public function resrve(Request $request)
    {
        $staff = Staff::where('reservation_code', $request->reservation_code)->get();
        if ($staff->isEmpty()) {
            return ['status' => 400, 'message' => 'Invalid Code!'];
        }

        $hour = $request->reserved_time['HH'];
        $minute = $request->reserved_time['mm'];

        $status = Carbon::now() < Carbon::createFromTime($hour, $minute) ? true : false;
        if (!$status) {
           return ['status' => $status, 'message' => 'Invalid Time!'];
        }

        $results = Parking::where('status_id', 1)->where(function ($query) use ($request){
            $query->where('reservation_code', $request->reservation_code);
        })->get();

        if (!$results->isEmpty()) {
            return response()->json(['status' => 400, 'message' => 'You have already parked your vehicle at Block ' . $results->first()->slot_id]);
        }

        $results2 = Reservation::where('status_id', 1)->where(function ($query) use ($request){
            $query->where('reservation_code', $request->reservation_code);
        })->get();

        if (!$results2->isEmpty()) {
            return response()->json(['status' => 400, 'message' => 'You have already reserved Block ' . $results2->first()->slot_id]);
        }


        $reservedTime = Carbon::createFromTime($hour, $minute);
        $expiresIn = $reservedTime->addMinute(30);
        $data = [
            'slot_id' => $request->slot_id,
            'name' => $staff->first()->name,
            'phone_number' => $staff->first()->phone_number,
            'email' => $staff->first()->email,
            'status_id' => 1,
            'reservation_code' => $request->reservation_code,
            'reserved_time' => Carbon::createFromTime($hour, $minute),
            'expires_in' => $expiresIn,
        ];

        $slot = Slot::findOrFail($request->slot_id);
        $slot->status_id = 2;
        $slot->update();
        Reservation::create($data);
        return ['status' => 200, 'message' => 'Success'];
    }

    public function search(Request $request)
    {
        // DB::table('staff_members')->where('type_id', '!=', 4)->latest()->paginate(10);
        if ($search = $request->get('q')) {
            $users = DB::table('staff_members')->where('type_id', '!=', 4)->where(function($query) use ($search) {
                $query->where('name', 'LIKE', "%$search%")
                ->orWhere('email', 'LIKE', "%$search%")
                ->orWhere('type_name', 'LIKE', "%$search%");
            })->paginate(10);
        } else {
            $users = DB::table('staff_members')->where('type_id', '!=', 4)->latest()->paginate(10);
        }
        return $users;
    }

    public function tempSearch(Request $request)
    {
        // DB::table('staff_members')->where('type_id', '!=', 4)->latest()->paginate(10);
        if ($search = $request->get('q')) {
            $users = DB::table('staff_members')->where('type_id', 4)->where(function($query) use ($search) {
                $query->where('name', 'LIKE', "%$search%")
                ->orWhere('email', 'LIKE', "%$search%")
                ->orWhere('type_name', 'LIKE', "%$search%");
            })->paginate(10);
        } else {
            $users = DB::table('staff_members')->where('type_id', 4)->latest()->paginate(10);
        }
        return $users;
    }
}
