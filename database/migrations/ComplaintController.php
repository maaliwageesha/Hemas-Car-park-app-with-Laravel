<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\complaint;

class ComplaintController extends Controller
{
    public function index()
    {
        return Complaint::latest()->get();
    }

    public function store(Request $request)
    {
        $validated_data = $this->validate($request, [
            'name' => 'required',
            'email' => 'email|required|max:155',
            'complaint' => 'required|min:5',
        ]);
        Complaint::create($validated_data);
        return ['status' => 200, 'message' => 'success'];
    }
    //destroy
    public function destroy($id)
    {
        $complaint = Complaint::findOrFail($id);
        $complaint->delete();
        return ['message' => 'Complaint deleted successfully!'];
    }
}
