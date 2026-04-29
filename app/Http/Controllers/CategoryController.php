<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Services\AutoTranslateService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('news')->latest()->paginate(10);

        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:categories,name'],
        ]);

        $data['slug'] = Str::slug($data['name']);

        $translator = app(AutoTranslateService::class);
        $data['name_en'] = $translator->translate($data['name'], 'en');
        $data['name_hi'] = $translator->translate($data['name'], 'hi');

        Category::create($data);

        return redirect()->route('categories.index')->with('success', 'Category created.');
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:categories,name,'.$category->id],
        ]);

        $data['slug'] = Str::slug($data['name']);

        $translator = app(AutoTranslateService::class);
        $data['name_en'] = $translator->translate($data['name'], 'en');
        $data['name_hi'] = $translator->translate($data['name'], 'hi');

        $category->update($data);

        return redirect()->route('categories.index')->with('success', 'Category updated.');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted.');
    }
}

