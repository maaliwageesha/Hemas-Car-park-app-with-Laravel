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
  
    public function index()
    {
        return Message::latest()->get();
    }



    public function store(Request $request)
    {     
        $validated_data = $request->validate([
            'title' => 'required|min:5|max:50',
            'content' => 'required|min:5',
        ]);
        return Message::create($validated_data);
    }


 public function update(Request $request, $id)
    {    
        $message = Message::findOrFail($id);

        $validated_data = $request->validate([
            'title' => 'required|min:5|max:50',
            'content' => 'required|min:5',
        ]);
        $message->update($validated_data);
    }




  
   
    public function destroy($id)
    {
        $message = Message::findOrFail($id);
        $message->delete();
        return ['message' => 'Message template deleted successfully!'];
    }




  
     public function send(Request $request)
    {
     
        $request->validate([
            'message_id' => 'required'
        ]);
     
        $slot_id = $request->slot_id;

        
        $message_id = $request->message_id;

       
        if ($request->type === 'paraked') {

      
            $parking_user = Parking::where(['slot_id' => $slot_id, 'status_id' => 1])->first();
        } else {
        
            $parking_user = Reservation::where(['slot_id' => $slot_id, 'status_id' => 1])->first();
        }


    
       $message = Message::findOrFail($message_id);

    
       
       $parking_user_email = $parking_user->email;
      
       $data = [
            'parking_user_name' => $parking_user->name,
            'message_title' => $message->title,
            'message_content' => $message->content
       ];

 
       Mail::to($parking_user_email)->send(new HemasAuthority($data));
       return ['status' => 200, 'message' => 'Success'];


    }
}
