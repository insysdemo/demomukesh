<?php

namespace App\Traits;

use App\Models\Notification;
use App\Models\User;

trait SendsNotifications
{
    /**
     * Send a notification to a user.
     *
     * @param int $userId
     * @param string $type
     * @param string $title
     * @param string $body
     * @return Notification|bool
     */
    public function sendNotification($userId, $type, $title, $body)
    {
        // print_r( $body);die;    
       
        $user = User::find($userId);
    
        if (!$user) {
            return false;
        }
    
        if ($user->notification == 0) {
            return false;
        }
    
        $notification = new Notification();
        $notification->user_id = $userId;
        $notification->notification_type = $type;
        $notification->title = $title;
        $notification->notification = $body;
        $notification->save();
    // print_r( $notification);die;
        return $notification;
    }  
    
}