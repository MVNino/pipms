<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests;
use App\Applicant;
use App\Copyright;
use App\Patent;
use App\User;
use Carbon\Carbon;

class TransactionController extends Controller
{
    /*--------------------------------------|
	 *	Transaction module					|
	 *--------------------------------------|
    **/
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['requestInitialCopyrightForm']]);
    }

    public function random_code()
    {
        return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 32);
    }

    public function upStatus($id)
    {
        $copyright = Copyright::findOrFail($id);
        if ($copyright->char_copyright_status == 'pending') {
            $copyright->char_copyright_status = 'To submit';
            $promptMsg = "The record changed its status to 'To submit'. 
            An email notification has been sent to applicant.";
            $copyright->save();
            return redirect('/admin/transaction/copyrights/pend-request')->with('success', $promptMsg);
        } else if ($copyright->char_copyright_status == 'To submit') {
            $copyright->char_copyright_status = 'On process';
            $promptMsg = "Request in now on process to its copyright registration";
            $copyright->save();
            return redirect('/admin/transaction/copyrights/to-submit')->with('success', $promptMsg);
        } else if ($copyright->char_copyright_status == 'On process') {
            $copyright->char_copyright_status = 'Copyrighted';
            $promptMsg = "Request in now copyrighted";
            $copyright->save();
            return redirect('/admin/transaction/copyrights/on-process')->with('success', $promptMsg);
        }
    }
}