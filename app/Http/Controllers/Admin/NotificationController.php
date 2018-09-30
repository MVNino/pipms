<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notification;

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

    public function viewNotifications()
    {
        $notifications = Notification::orderBy('created_at', 'desc')->get();
    	return view('admin.notification', 
            ['notifications' => $notifications]);
    }
}
