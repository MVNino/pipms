<?php

namespace App\Http\Controllers\Maintenance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;
use App\Message;

class MailController extends Controller
{
    public function viewMails()
    {
        $mails = Message::all();
        
     return view('admin.maintenance.mail', ['mails'=>$mails]);  
    }
}
