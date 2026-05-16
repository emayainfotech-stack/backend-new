<?php

namespace App\Services;

use App\Models\News;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FirebaseNotificationService
{
    private const EXPO_PUSH_URL = 'https://exp.host/--/api/v2/push/send';

    public function sendPushNotificationIfNeeded(News $news): void
    {
        if (! $news->send_push_notification || $news->status !== 'published' || $news->push_sent_at) {
            return;
        }

        $imageUrl = $this->newsImageUrl($news);
        $data = [
            'news_id' => (string) $news->id,
            'screen' => 'news-detail',
        ];

        $tokens = DB::table('device_tokens')->pluck('token');

        foreach ($tokens as $token) {
            $this->sendToToken($token, $news->title, $news->short_description, $data, $imageUrl, $news->id);
        }

        $news->forceFill(['push_sent_at' => now()])->save();
    }

    public function sendToAll(string $title, string $body, array $data = [], ?string $imageUrl = null): bool
    {
        $tokens = DB::table('device_tokens')
            ->distinct()
            ->pluck('token');

        if ($tokens->isEmpty()) {
            return false;
        }

        foreach ($tokens as $token) {
            $this->sendToToken($token, $title, $body, $data, $imageUrl);
        }

        return true;
    }

    /**
     * Expo does not support topics like FCM.
     * For compatibility, this method sends to all tokens.
     */
    public function sendToTopic($topic, string $title, string $body, array $data = [], ?string $imageUrl = null): bool
    {
        return $this->sendToAll($title, $body, $data, $imageUrl);
    }

    /**
     * @return array{status: int, body: string}|null
     */
    public function sendToToken(
        string $token,
        string $title,
        string $body,
        array $data = [],
        ?string $imageUrl = null,
        ?int $newsId = null,
    ): ?array {
        try {
            $response = Http::post(
                self::EXPO_PUSH_URL,
                $this->buildPayload($token, $title, $body, $data, $imageUrl),
            );

            if ($response->failed()) {
                Log::warning('Expo push API returned non-success response', [
                    'token' => $token,
                    'news_id' => $newsId,
                    'status' => $response->status(),
                    'response' => $response->body(),
                ]);
            }

            return [
                'status' => $response->status(),
                'body' => $response->body(),
            ];
        } catch (\Throwable $e) {
            Log::warning('Expo push send failed', [
                'token' => $token,
                'news_id' => $newsId,
                'error' => $e->getMessage(),
            ]);

            return null;
        }
    }

    private function buildPayload(
        string $token,
        string $title,
        string $body,
        array $data,
        ?string $imageUrl,
    ): array {
        $payload = [
            'to' => $token,
            'title' => $title,
            'body' => $body,
            'sound' => 'default',
        ];

        if ($data !== []) {
            $payload['data'] = $data;
        }

        if ($imageUrl) {
            $payload['richContent'] = [
                'image' => $imageUrl,
            ];
        }

        return $payload;
    }

    private function newsImageUrl(News $news): ?string
    {
        if ($news->media_type === 'video') {
            if (! empty($news->thumbnail_path)) {
                return asset('storage/' . $news->thumbnail_path);
            }

            return null;
        }

        if (! empty($news->media_path)) {
            return asset('storage/' . $news->media_path);
        }

        return null;
    }
}
