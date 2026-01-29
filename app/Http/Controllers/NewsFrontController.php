<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsFrontController extends Controller
{
    public function index()
    {
        $news = News::where('is_published', true)
                    ->orderBy('published_date', 'desc')
                    ->paginate(9);
        
        return view('news.index', compact('news'));
    }

    public function show($slug)
    {
        $news = News::where('slug', $slug)
                    ->where('is_published', true)
                    ->firstOrFail();
        
        return view('news.show', compact('news'));
    }
}