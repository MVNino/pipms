<?php

namespace App\Http\Controllers\Author;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MailController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function viewMails()
    {
        return view('author-pd.my-mails');
    }
}
