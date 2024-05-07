<?php

namespace App\Http\Controllers;

use App\Models\Host;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        // if (Auth::check()) {
        //     $notificationsCount = Auth::user()->unreadNotifications()->count();
        //     return response()->json(['notifications_count' => $notificationsCount]);
        // } else {
        //     return response()->json(['error' => 'Unauthorized'], 401);
        // }
        $host = Host::find(1);
        $user = $host->user;
        if ($user) {
            $notifications = $user->unreadNotifications()->get();
            $notificationsCount = $user->unreadNotifications()->count();
            return response()->json([
                'host' => $host,
                'notifications_count' => $notificationsCount,
                'notifications' => $notifications,
                
            ]);
        } else {
            return response()->json(['error' => 'User not found'], 404);
        }
    }

    public function mark_notification_as_read($id){
        DB::table("notifications")->where('id', $id)->update(["read_at" => now()]);
        return response()->json(["message" => "Notification marked as read !"]);
    }
}
