<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryApiController extends Controller
{
    public function index(Request $request)
    {
        $lang = strtolower((string) $request->get('lang', 'en'));
        $lang = in_array($lang, ['en', 'hi']) ? $lang : 'en';

        $categories = Category::query()
            ->orderBy('name')
            ->get(['id', 'name', 'name_en', 'name_hi', 'slug']);

        $data = $categories->map(function (Category $c) use ($lang) {
            $label = $lang === 'hi'
                ? (string) ($c->name_hi ?: ($c->name ?: ($c->name_en ?: '')))
                : (string) ($c->name_en ?: ($c->name ?: ($c->name_hi ?: '')));

            return [
                'id' => $c->id,
                'name' => $label,
                'slug' => $c->slug,
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }
}

