<?php

namespace App\Notify;

use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Notification;

class GitNotifiable
{
    use Notifiable;

    /**
     * Route notifications for the mail channel.
     *
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return string
     */

    public function routeNotificationForMail($notification): array|string
    {

        return ['jerry40522@gmail.com' => 'selfNotify'];
        // return 'jerry40522@gmail.com';
    }
}
