<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Payment;

class PaymentController extends Controller
{
    public function index()
    {
        $payment_details = [];
        $payments = Payment::latest()->get();
        foreach ($payments as $key => $payment) {
            $payment->parking;
            array_push($payment_details, $payment);
        }
        return ['payments' => $payment_details];
    }

    public function filter(Request $request)
    {
        $payment_details = [];
        $date1 = $request->get('date1');
        $date2 = $request->get('date2');
        $payments = Payment::whereBetween('created_at', [$date1, $date2])->latest()->get();

        foreach ($payments as $key => $payment) {
            $payment->parking;
            array_push($payment_details, $payment);
        }
        return ['payments' => $payment_details];
    }

    public function search(Request $request)
    {
        $payment_details = [];
        if ($search = $request->get('q')) {
            $payments = Payment::where(function($query) use ($search) {
                $query->where('name', 'LIKE', "%$search%")
                ->orWhere('phone_number', 'LIKE', "%$search%")
                ->orWhere('reservation_code', 'LIKE', "%$search%");
            })->paginate(10);

            foreach ($payments as $key => $payment) {
                $payment->parking;
            array_push($payment_details, $payment);
        }
        } else {
                $payments = Payment::latest()->get();
                foreach ($payments as $key => $payment) {
                    $payment->parking;
                    array_push($payment_details, $payment);
        }
    }
    return ['payments' => $payment_details];
    }

    public function destroy($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->delete();
        return ['message' => 'Payment deleted successfully!'];
    }
}
