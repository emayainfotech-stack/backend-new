<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
class ShareRedirectController extends Controller
{
    //public function open($id)
    public function redirect($id)
    {
        $news = News::findOrFail($id);

        if (!$news) {
            return redirect('https://play.google.com/store/apps/details?id=com.mycityonly.app');
        }

        $image = $news->media_type === 'video'
            ? ($news->thumbnail_path ? asset('storage/' . $news->thumbnail_path) : '')
            : ($news->media_path ? asset('storage/' . $news->media_path) : '');

        $title = $news->title;
        $desc = $news->short_description;

        return response("
        <html>
        <head>
            <title>{$title}</title>
            <meta property='og:title' content='{$title}' />
            <meta property='og:description' content='{$desc}' />
            <meta property='og:image' content='{$image}' />
            <meta property='og:url' content='https://mycityonly.com/s/{$id}' />
            <meta property='og:type' content='article' />

            <script>
                window.location.href = 'mycityonly://news/{$id}';
                setTimeout(function() {
                    window.location.href = 'https://play.google.com/store/apps/details?id=com.mycityonly.app';
                }, 1200);
            </script>
        </head>
        <body></body>
        </html>
        ");
    }
}
