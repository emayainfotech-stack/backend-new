<?php

namespace App\Http\Controllers;

use App\Models\News;

class ShareRedirectController extends Controller
{
    public function redirect($id)
    {
        // findOrFail nahi — warna niche wala fallback kabhi nahi chalega
        $news = News::find($id);

        if (!$news) {
            return redirect('https://play.google.com/store/apps/details?id=com.mycityonlynew.app');
        }

        $image = $news->media_type === 'video'
            ? ($news->thumbnail_path ? asset('storage/' . $news->thumbnail_path) : '')
            : ($news->media_path ? asset('storage/' . $news->media_path) : '');

        // HTML injection se bachne ke liye escape
        $title = htmlspecialchars($news->title, ENT_QUOTES, 'UTF-8');
        $image = htmlspecialchars($image, ENT_QUOTES, 'UTF-8');
        $id = (int) $id;

        return response("
        <html>
        <head>
            <title>{$title}</title>

            <!-- og:title HATA diya: WhatsApp card me title nahi dikhega, sirf image -->
            <meta property='og:image' content='{$image}' />
            <meta property='og:url' content='" . url("/s/{$id}") . "' />
            <meta property='og:type' content='article' />

            <script>
                window.location.href = 'mycityonly://news/{$id}';
                setTimeout(function() {
                    var ua = navigator.userAgent || '';
                    if (/iPhone|iPad|iPod/i.test(ua)) {
                        window.location.href = 'https://apps.apple.com/app/idYOUR_APP_ID';
                    } else {
                        window.location.href = 'https://play.google.com/store/apps/details?id=com.mycityonlynew.app';
                    }
                }, 1500);
            </script>
        </head>
        <body></body>
        </html>
        ");
    }
}
