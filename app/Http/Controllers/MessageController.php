<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\HemasAuthority;
use App\Message;
use App\Parking;
use App\Reservation;

class MessageController extends Controller
{
    //
    public function index()
    {
        return Message::latest()->get();
    }



    //message store methord
    public function store(Request $request)
    {     //message validation
        $validated_data = $request->validate([
            'title' => 'required|min:5|max:50',
            'content' => 'required|min:5',
        ]);
        return Message::create($validated_data);
    }



    //message update methord 
    public function update(Request $request, $id)
    {    //same validation applied to the update 
        $message = Message::findOrFail($id);

        $validated_data = $request->validate([
            'title' => 'required|min:5|max:50',
            'content' => 'required|min:5',
        ]);
        $message->update($validated_data);
    }




    //message delete methord 
   
    public function destroy($id)
    {
        $message = Message::findOrFail($id);
        $message->delete();
        return ['message' => 'Message template deleted successfully!'];
    }




    //send email funtion
    //message can send to only two kind of users parked or reserved.
     public function send(Request $request)
    {
        //for happen this one message id is must , this also a validation part .
        $request->validate([
            'message_id' => 'required'
        ]);
        //access the user input and assigen in to a variable.
        $slot_id = $request->slot_id;

        //get the message id form the request and asign in to a variable.
        $message_id = $request->message_id;

        //get the type from  the reqest and check wether it is parked or not. 
        if ($request->type === 'paraked') {

        //check the slot_id & status_id from the parking table. and assign in to $parking_user. 
            $parking_user = Parking::where(['slot_id' => $slot_id, 'status_id' => 1])->first();
        } else {
        //check the slot_id & status_id from the Reservation table. and assign in to $parking_user.   
            $parking_user = Reservation::where(['slot_id' => $slot_id, 'status_id' => 1])->first();
        }


       //check the message id from the message table
       $message = Message::findOrFail($message_id);

       //allready find the slot_id and status_id and assigend it to $parking_user
       
       $parking_user_email = $parking_user->email;
       //$data is a object type array
       $data = [
            'parking_user_name' => $parking_user->name,
            'message_title' => $message->title,
            'message_content' => $message->content
       ];

       //conroller ekate response ekata adalawa thama success eka print wenneh ekak /okkoma gatta data HemasAuthority ekata yawanwa
       Mail::to($parking_user_email)->send(new HemasAuthority($data));
       return ['status' => 200, 'message' => 'Success'];

      // hemasAuthority path ----> app  / Mail / HemasAuthority 
    }
}
