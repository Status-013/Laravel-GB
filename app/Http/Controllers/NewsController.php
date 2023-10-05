<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NewsController extends Controller
{
    public function index(int $categoryId = null): View
    {
        if ($categoryId) {
            $category = Category::find($categoryId);
            $news = $category->news()->active()->paginate(10);
        } else {
            $news = News::active()->paginate(10);
        }

        return view('news.index', [
            'news' => $news,
            'categoryName' => $category->name ?? 'All'
        ]);
    }

    public function show(string $categoryId, string $postId): View
    {
        $category = Category::find($categoryId);
        $post = News::active()->find($postId);

        if (!$post || $category->id !== $post->category->id) {
            abort(404);
        }

        return view('news.show', ['categoryName' => $category->name, 'post' => $post]);
    }
}
