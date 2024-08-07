<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Video extends Model
{
    use HasFactory;
    protected $fillable = [
        'channel_id', 'title', 'body', 'published_at', 'vimeo_url', 'youtube_url', 'youtube_title', 'myday_image'
    ];
    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function channels(): BelongsToMany
    {
        return $this->belongsToMany(Channel::class, 'channel_video',  'video_id', 'channel_id');
    }

    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(
            Genre::class,
            'video_genres', // Pivot table name
            'video_id',     // Foreign key for the current model
            'genre_id'      // Foreign key for the related model
        )->using(VideoGenre::class);
    }
}
