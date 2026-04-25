<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class FirebaseNotificationService
{
    /**
     * Send notification to all users
     */
    public function sendToAll($title, $body, $data = [])
    {
        $tokens = DB::table('device_tokens')
            ->distinct()
            ->pluck('token')
            ->toArray();

        if (empty($tokens)) return false;

        foreach ($tokens as $token) {
            Http::post('https://exp.host/--/api/v2/push/send', [
                'to' => $token,
                'title' => $title,
                'body' => $body,
                'data' => $data,
            ]);
        }

        return true;
    }

    /**
     * Expo does not support topics like FCM.
     * For compatibility, this method sends to all tokens.
     */
    public function sendToTopic($topic, $title, $body, $data = [])
    {
        return $this->sendToAll($title, $body, $data);
    }
}