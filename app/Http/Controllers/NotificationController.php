<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function readNotif($id)
    {
    	// $notification = DB::table('notifications')->where('id', $id)->get();
    	$notification = Notification::findOrFail($id);
    	$notification->read_at = now();
    	$notification->save();
    	return redirect('/admin/transaction/copyrights/pend-request');
    }

    public function readAll()
    {
    	auth()->user()->unreadNotifications->markAsRead();
    	return redirect()->back();
    }
}
