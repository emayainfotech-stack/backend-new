<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class AutoTranslateService
{
    private string $endpoint = 'https://translate.googleapis.com/translate_a/single';
    private int $timeoutSeconds = 8;

    public function __construct()
    {
    }

    public function translate(string $text, string $target): string
    {
        $text = trim($text);
        if ($text === '') return $text;

        try {
            $response = Http::timeout($this->timeoutSeconds)->get($this->endpoint, [
                'client' => 'gtx',
                'sl' => 'auto',
                'tl' => $target,
                'dt' => 't',
                'q' => $text,
            ]);

            if ($response->failed()) {
                return $text;
            }

            $json = $response->json();
            if (! is_array($json) || ! isset($json[0]) || ! is_array($json[0])) {
                return $text;
            }

            $parts = [];
            foreach ($json[0] as $chunk) {
                if (is_array($chunk) && isset($chunk[0]) && is_string($chunk[0])) {
                    $parts[] = $chunk[0];
                }
            }

            $translated = trim(implode('', $parts));
            return $translated !== '' ? $translated : $text;
        } catch (\Throwable $e) {
            return $text;
        }
    }
}

