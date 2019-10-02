<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReservationMail;
use App\Reservation;
use App\Parking;
use App\Slot;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $reservations = Reservation::latest()->get();

        return ['reservations' => $reservations];
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
            'status_id' => '',
            'reserved_time' => '',
            'expires_in' => '',
            'reservation_code' => ''
        ]);


        $results2 = Reservation::where('status_id', 1)->where(function ($query) use ($validated_data){
            $query->where('email', $validated_data['email'])
                  ->orWhere('phone_number', $validated_data['phone_number']);
        })->get();

        if (!$results2->isEmpty()) {
            return response()->json(['status' => 400, 'message' => 'You have already reserved Block ' . $results2->first()->slot_id]);
        }

        $results = Parking::where('status_id', 1)->where(function ($query) use ($validated_data){
            $query->where('email', $validated_data['email'])
                  ->orWhere('phone_number', $validated_data['phone_number']);
        })->get();

        if (!$results->isEmpty()) {
            return response()->json(['status' => 400, 'message' => 'You have already parked your vehicle at Block ' . $results->first()->slot_id]);
        }

        $hour = $request->reserved_time['HH'];
        $minute = $request->reserved_time['mm'];

        $status = Carbon::now() < Carbon::createFromTime($hour, $minute) ? true : false;
        if (!$status) {
           return ['status' => $status, 'message' => 'Invalid Time!'];
        }

        $reservedTime = Carbon::createFromTime($hour, $minute);
        $expiresIn = $reservedTime->addMinute(30);
        $res_code = 'R-' .rand(1000, 9999);
        $validated_data = array_merge($validated_data, ['reserved_time' => Carbon::createFromTime($hour, $minute), 'expires_in' => $expiresIn, 'reservation_code' => $res_code]);
        $slot = Slot::findOrFail($request->slot_id);
        $slot->status_id = 2;
        $slot->update();
        Reservation::create($validated_data);

        // return new ReservationMail($validated_data);
        Mail::to($validated_data['email'])->send(new ReservationMail($validated_data));

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
        $complaint = Reservation::findOrFail($id);
        Slot::findOrFail($complaint->slot_id)->update(['status_id' => 0]);
        $complaint->delete();
        return ['message' => 'Reservation deleted successfully!'];
    }
    public function check(Request $request)
    {
        $result = Reservation::where(['reservation_code' => $request->reservation_code, 'status_id' => 1, 'slot_id' =>  $request->slot_id])->get();

        if ($result->isEmpty()) {
            return ['status' => 400, 'message' => 'Invalid Code!'];
        }

        $result->first()->status_id = 0;
        $result->first()->update();

        $parking = new Parking();
        $parking->slot_id = $request->slot_id;
        $parking->name = $result->first()->name;
        $parking->phone_number = $result->first()->phone_number;
        $parking->email = $result->first()->email;
        $parking->status_id = '1';
        $parking->reservation_code = $result->first()->reservation_code;
        $parking->created_at = $result->first()->reserved_time;
        $parking->save(['timestamps' => false]);

        $slot = Slot::findOrFail($request->slot_id);
        $slot->status_id = 1;
        $slot->update();

        return ['status' => 200, 'message' => 'Success'];

    }

    public function checkReserveExpires()
    {
        $reservations = Reservation::where('status_id', 1)->get();
        foreach ($reservations as $key => $reservation) {
            $status = Carbon::now() >= Carbon::parse($reservation->expires_in) ? true : false;
            if ($status) {
                $reservation->status_id = 0;
                $reservation->update();

                $slot = Slot::where('id', $reservation->slot_id)->first();
                $slot->status_id = 0;
                $slot->update();
                return ['status' => 200, 'message' => 'Success'];
            }
        }
    }

     public function filter(Request $request)
    {
        $reservation_details = [];
        $date1 = $request->get('date1');
        $date2 = $request->get('date2');
        $reservations = Reservation::whereBetween('created_at', [$date1, $date2])->latest()->get();

        return ['reservations' => $reservations];
    }

     public function search(Request $request)
    {
        if ($search = $request->get('q')) {
            $reservations = DB::table('reservations')->where(function($query) use ($search) {
                $query->where('name', 'LIKE', "%$search%")
                ->orWhere('email', 'LIKE', "%$search%")
                ->orWhere('phone_number', 'LIKE', "%$search%");
            })->paginate(10);
        } else {
            $reservations = DB::table('reservations')->latest()->paginate(10);
        }
        return $reservations;
    }
}
