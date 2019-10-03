<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Parking;
use App\Reservation;
use App\Slot;
use App\Staff;
use App\Payment;

class ParkingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $free_slots = Slot::where('status_id', 0)->get('id');
        $parked_slots = Slot::where('status_id', 1)->get('id');
        $reserved_slots = Slot::where('status_id', 2)->get('id');
        return [ 'free' => $free_slots, 'parked' => $parked_slots, 'reserved' => $reserved_slots];
    }

    public function details()
    {
        $active_parkings = Parking::where(['status_id' => 1])->latest()->get();
        $deactivated_parkings = Parking::where(['status_id' => 2])->latest()->get();
        return [ 'active_parkings' => $active_parkings, 'deactivated_parkings' => $deactivated_parkings];
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
            'slot_id' => '',
            'name' => 'required',
            'phone_number' => 'required|max:10',
            'email' => 'email|required|max:155',
            'status_id' => ''
        ]);



        $results = Parking::where('status_id', 1)->where(function ($query) use ($validated_data){
            $query->where('email', $validated_data['email'])
                  ->orWhere('phone_number', $validated_data['phone_number']);
        })->get();

        if (!$results->isEmpty()) {
            return response()->json(['status' => 400, 'message' => 'You have already parked your vehicle at Block ' . $results->first()->slot_id]);
        }

        $results2 = Reservation::where('status_id', 1)->where(function ($query) use ($validated_data){
            $query->where('email', $validated_data['email'])
                  ->orWhere('phone_number', $validated_data['phone_number']);
        })->get();

        if (!$results2->isEmpty()) {
            return response()->json(['status' => 400, 'message' => 'You have already reserved Block ' . $results2->first()->slot_id]);
        }

        Parking::create($validated_data);
        $slot = Slot::findOrFail($request->slot_id);
        $slot->status_id = 1;
        $slot->update();
        return ['status' => 200, 'message' => 'Success'];
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function check(Request $request)
    {

        $result = Parking::where('status_id', 1)->where(function ($query) use ($request){
            $query->where('phone_number', $request->phoneOrId)
                  ->orWhere('reservation_code', $request->phoneOrId);
        })->get();

        if ($result->isEmpty()) {
            return ['status' => 400, 'message' => 'No Records Found!'];
        }

        $chargePerHour = 40;
        if (substr($request->phoneOrId,0,1) == 'S') {
            $result->first()->updated_at = now();
            $result->first()->status_id = 2;
            $result->first()->update();

            $slot_id = $result->first()->slot_id;
            $slot = Slot::findOrFail($slot_id);
            $slot->status_id = 0;
            $slot->update();

            return ['status' => 200, 'message' => 'success', 'type' => 'staff', 'parking_id' => $result->first()->id];
        } else if(substr($request->phoneOrId,0,1) == 'V') {
            $staff_member = Staff::where('reservation_code', $request->phoneOrId)->first();
            $chargePerHour = $staff_member->type->chargePerHour;
        } else if(substr($request->phoneOrId,0,1) == 'R') {
            $staff_member = Staff::where('reservation_code', $request->phoneOrId)->first();
            $chargePerHour = 50;
        }


        $created = new Carbon($result->first()->created_at);
        $now = Carbon::now();
        $created_time_stamp = $result->first()->created_at->timestamp;
        // $created_time_stamp = strtotime($result->first()->created_at);
        $now_time_stamp = Carbon::now()->timestamp;
        $diff_in_minutes = floor(($now_time_stamp - $created_time_stamp) / 60);
        $charges = floor(($chargePerHour / 60) * $diff_in_minutes);
        if(substr($request->phoneOrId,0,1) == 'V') {
            $staff_member = Staff::where('reservation_code', $request->phoneOrId)->first();
            if ($staff_member->initial_payment == 0) {
                $charges = $charges + 300;
            }
        }
        $difference = $created->diff($now);
        $total_time = $difference->h .'h '.$difference->i .'m';
        $inTime = $result->first()->created_at->format('h : i a');
        $outTime = $now->format('h : i a');
        // $ts = $total_time->timestamp; strtotime(new Date())
        // $difference = $created->diffForHumans($now);
        $result->first()->updated_at = now();
        $result->first()->status_id = 2;
        $result->first()->update();

        $slot_id = $result->first()->slot_id;
        $slot = Slot::findOrFail($slot_id);
        $slot->status_id = 0;
        $slot->update();

        // Payment::create(['parking_id' => $result->first()->id, 'status_id' => 1]);
        $result->first()->payment()->create(['status_id' => 1, 'charges' => $charges, 'name' => $result->first()->name, 'phone_number' => $result->first()->phone_number, 'reservation_code' => $result->first()->reservation_code]);
        return [
            'created' => $created,
            'phone_number' => $result->first()->phone_number,
            'reservation_id' => (substr($request->phoneOrId,0,1) === 'S' || substr($request->phoneOrId,0,1)  === 'R') ? $request->phoneOrId : '',
            'in_Time' => $inTime,
            'out_Time' => $outTime,
            'diff' => $total_time,
            'minutes' => $diff_in_minutes,
            'charges' => $charges,
            'parking_id' => $result->first()->id,
        ];
        // return [
        //     'Date' => $result->first()->created_at->format('Y-m-d'),
        //     'Time' => $result->first()->created_at->format('H : i : s'),
        //     'EndTime' => Carbon::now()->format('H : i : s'),
        //     'Time_timestamp' => $result->first()->created_at->timestamp,
        //     'EndTime_timestamp' => Carbon::now()->timestamp,
        //     'diff' => Carbon::now()->timestamp - $result->first()->created_at->timestamp,
        //     'diff_intime' => date(" i : s", strtotime(Carbon::now()->timestamp - $result->first()->created_at->timestamp))
        // ];
    }
    public function paimentSettled(Request $request)
    {
        $payment = Payment::where('parking_id', $request->parking_id)->first();
        $payment->status_id = $request->status;
        $payment->update();

        if(substr($payment->reservation_code,0,1) == 'V') {
            $staff_member = Staff::where('reservation_code', $payment->reservation_code)->first();
            if ($staff_member->initial_payment == 0) {
                $staff_member->initial_payment = 1;
                $staff_member->update();
            }
        }

        return ['status' => 200, 'message' => 'success'];
    }
}
