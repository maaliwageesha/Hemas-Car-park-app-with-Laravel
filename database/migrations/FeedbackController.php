<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Feedback;
use App\Parking;

class FeedbackController extends Controller
{
    public function index()
    {
        $feedback_details = [];
        $feedbacks = Feedback::latest()->get();
        foreach ($feedbacks as $key => $feedback) {
            $feedback->parking;
            array_push($feedback_details, $feedback);
        }
        return ['feedbacks' => $feedback_details];
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'feedback' => 'required|min:3'
        ]);

        Feedback::create(['feedback' => $request->feedback, 'parking_id' => $request->parking_id, 'rating' => $request->rating]);
        return ['status' => 200, 'message' => 'Success'];
    }

    public function destroy($id)
    {
        $feedback = Feedback::findOrFail($id);
        $feedback->delete();
        return ['message' => 'Feedback deleted successfully!'];
    }
}
