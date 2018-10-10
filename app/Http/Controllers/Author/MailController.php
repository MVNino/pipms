<?php

namespace App\Http\Controllers\Author;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;
use DB;
use App\Message;

class MailController extends Controller
{
   
    public function viewMyMails()
    {
        $mails = Message::all()->where('sender_id', 1);
     return view('author-pd.mails', ['mails'=>$mails] );  
    }

    public function viewMyMessage($id)
    {
        $mails = Message::findOrFail($id);
        return view('author-pd.view-my-message', ['mails' => $mails]);
    }

    public function MySent()
    {
        $mails = Message::all()->where('sender_id', 0);
        
     return view('author-pd.sent', ['mails'=>$mails]);  
    }

    public function viewMySent($id)
    {
        $mails = Message::findOrFail($id);
        return view('author-pd.view-my-sent', ['mails' => $mails]);
    }

    public function MyTrash()
    {
        $mails = Message::all()->where('char_message_status', 1);
        
     return view('author-pd.trash', ['mails'=>$mails]);  
    }

     public function composeMails(Request $request)
    {	
        $this->validate($request, [
  			'email' => 'required|string|max:5000',
  			'subject' => 'required|string|max:5000',
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
      $message->sender_name = 'User';
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
            $message->char_message_status = 1;


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
