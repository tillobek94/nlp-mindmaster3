<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::latest()->paginate(10);
        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'published_date' => 'required|date',
        ]);

        $news = new News();
        $news->title = $request->title;
        $news->slug = Str::slug($request->title) . '-' . time();
        $news->content = $request->content;
        $news->short_description = $request->short_description;
        $news->published_date = $request->published_date;
        $news->is_published = $request->has('is_published') ? true : false;
        
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('news', 'public');
            $news->image = $path;
        }
        
        $news->save();

        return redirect()->route('admin.news.index')
            ->with('success', 'Yangilik saqlandi!');
    }

    public function show($id)
    {
        $news = News::findOrFail($id);
        return view('admin.news.show', compact('news'));
    }

    public function edit($id)
    {
        $news = News::findOrFail($id);
        return view('admin.news.edit', compact('news'));
    }

    public function update(Request $request, $id)
    {
        $news = News::findOrFail($id);
        
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'published_date' => 'required|date',
        ]);
        
        $news->title = $request->title;
        $news->slug = Str::slug($request->title);
        $news->content = $request->content;
        $news->short_description = $request->short_description;
        $news->published_date = $request->published_date;
        $news->is_published = $request->has('is_published') ? true : false;
        
        if ($request->hasFile('image')) {
            if ($news->image) {
                \Storage::disk('public')->delete($news->image);
            }
            $path = $request->file('image')->store('news', 'public');
            $news->image = $path;
        }
        
        $news->save();

        return redirect()->route('admin.news.index')
            ->with('success', 'Yangilik yangilandi');
    }

    public function destroy($id)
    {
        $news = News::findOrFail($id);
        
        if ($news->image) {
            \Storage::disk('public')->delete($news->image);
        }
        
        $news->delete();

        return redirect()->route('admin.news.index')
            ->with('success', 'Yangilik o\'chirildi');
    }
}