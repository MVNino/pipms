<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use DB;
use App\Message;

class MailController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
  public function viewMails()
  {
      $mails = Message::where('receiver_id', 1)
                      ->orderBy('created_at', 'desc')->get();
      
   return view('admin.mail', ['mails'=>$mails]);  
  }

  public function viewMessage($id)
  {
      $mails = Message::findOrFail($id);
      return view('admin.view-message', ['mails' => $mails]);
  }

  public function Sent()
  {
      $mails = Message::where('sender_id', 1)
                      ->orderBy('created_at', 'desc')->get();
      
   return view('admin.sent', ['mails'=>$mails]);  
  }

  public function viewSent($id)
  {
      $mails = Message::findOrFail($id);
      return view('admin.view-sent', ['mails' => $mails]);
  }    

  public function Trash()
  {
      $mails = Message::where('char_message_status', 1)
                      ->orderBy('created_at', 'desc')->get();
      
   return view('admin.trash', ['mails'=>$mails]);  
  }

  public function viewTrash($id)
  {
      $mails = Message::findOrFail($id);
      return view('admin.view-trash', ['mails' => $mails]);
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
		$message->sender_id = 1;
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
