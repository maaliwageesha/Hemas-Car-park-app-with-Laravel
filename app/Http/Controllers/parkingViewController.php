<?php

namespace App\Http\Controllers;

use App\Parking;
use Illuminate\Http\Request;

class parkingViewController extends Controller
{

    public function index()
    {

        $Parkings = Parking::latest()->get();

        return ['parkings' => $Parkings];
    }


    public function search(Request $request)
    {
        if ($search = $request->get('q')) {
            $parkings = DB::table('parkings')->where(function($query) use ($search) {
                $query->where('name', 'LIKE', "%$search%")
                ->orWhere('email', 'LIKE', "%$search%")
                ->orWhere('phone_number', 'LIKE', "%$search%");
            })->paginate(10);
        } else {
            $parkings = DB::table('parkings')->latest()->paginate(10);
        }
        return $parkings;
    }

    public function filter(Request $request)
    {
        $parking_details = [];
        $date1 = $request->get('date1');
        $date2 = $request->get('date2');
        $parkings = Parking::whereBetween('created_at', [$date1, $date2])->latest()->get();

        return ['parkings' => $parkings];
    }

}
