<?php

namespace App\Http\Controllers\Author;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;
use DB;
use App\Message;
use Auth;

class MailController extends Controller
{
   
    public function viewMyMails()
    {
        $mails = Message::where('sender_id', 1)
                        ->orderBy('created_at', 'desc')->get();

     return view('author-pd.mails', ['mails'=>$mails] );  
    }

    public function viewMyMessage($id)
    {
        $mails = Message::findOrFail($id);
        return view('author-pd.view-my-message', ['mails' => $mails]);
    }

    public function MySent()
    {
        $mails = Message::where('sender_id', 0)
                        ->orderBy('created_at', 'desc')->get();
        
     return view('author-pd.sent', ['mails'=>$mails]);  
    }

    public function viewMySent($id)
    {
        $mails = Message::findOrFail($id);
        return view('author-pd.view-my-sent', ['mails' => $mails]);
    }


     public function composeMails(Request $request)
    {	
        $this->validate($request, [
  			'email' => 'required|string|max:5000',
  			'subject' => 'nullable|string|max:5000',
  			'message' => 'required|string|max:5000',
            
  		]);

      try 
      {
  		$message = new Message;
  		$message->sender_id = 0;
  		$message->receiver_id = 1;
  		$message->email = $request->email;
  		$message->str_subject = $request->subject;
  		$message->mdmTxt_message = $request->message;
      $message->sender_name = Auth::user()->email;
      $message->char_message_status = '0';
        

        if ($message->save()) {
        	return redirect()->back()->with('success', 'Message sent!');
        }

        }
        catch (\Exception $e)
        {
            return $e->getMessage();
        } 
    }

    public function replyMails(Request $request)
    { 
        $this->validate($request, [
        'email' => 'required|string|max:5000',
        'subject' => 'nullable|string|max:5000',
        'message' => 'required|string|max:5000',
            
      ]);

      try 
      {
      $message = new Message;
      $message->sender_id = 0;
      $message->receiver_id = 1;
      $message->email = $request->email;
      $message->str_subject = $request->subject;
      $message->mdmTxt_message = $request->message;
      $message->sender_name = 'Admin';
      $message->char_message_status = '0';
        

        if ($message->save()) {
          return redirect()->back()->with('success', 'Message sent!');
        }

        }
        catch (\Exception $e)
        {
            return $e->getMessage();
        } 
    }

    public function deleteMails($id)
    {
        try
        {
            $message = Message::find($id);
            $message->char_message_status = '1';


            if ($message->save())
            {
                return redirect()->back()->with('success', 'Message Deleted!');
            }

        }
        catch (\Exception $e)
        {
            return $e->getMessage();
        }
    }
}
