<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class NotificationController extends Controller
{

    public function index()
    {
        return [
            'read' => Auth::user()->readNotifications,
            // 'unread' => Auth::user()->unreadNotifications,
            'unread' => Auth::user()->unreadNotifications,
            'allnotfy' => Auth::user()->Notifications,
        ];
    }

    public function markasread(Request $request)
    {
        return Auth::user()->notifications->where('id', $request->id)->markAsRead();
    }

    public function readnot($id)
    {
        $notifications =  Auth::user()->notifications->where('id', $id)->first();
        $notifications->markasread();

        if ($notifications->type = "App\Notifications\InvoicePaid") {
            return redirect()->route('show', $notifications->data['id']);
        }
    }
}
