<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'image',
        'youtube_url', // <- ЯНГИ МАЙДОН
        'short_description',
        'is_published',
        'published_date'
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_date' => 'date'
    ];

    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }
        return asset('images/default-news.jpg');
    }

    // YouTube видео ID ни олиш учун метод
    public function getYoutubeIdAttribute()
    {
        if (!$this->youtube_url) {
            return null;
        }

        // YouTube URL даги ID ни олиш
        preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $this->youtube_url, $matches);
        
        return $matches[1] ?? null;
    }

    // YouTube embed кодини олиш
    public function getYoutubeEmbedHtmlAttribute()
    {
        if (!$youtubeId = $this->youtube_id) {
            return '';
        }

        return '<div class="youtube-video-container">
            <iframe 
                width="560" 
                height="315" 
                src="https://www.youtube.com/embed/' . $youtubeId . '" 
                frameborder="0" 
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                allowfullscreen>
            </iframe>
        </div>';
    }
}