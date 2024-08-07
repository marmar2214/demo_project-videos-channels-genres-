<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Genre extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
         'name', 'name_mm', 'status',
    ];

    public function videos(): BelongsToMany
    {
        return $this->belongsToMany(
             Video::class, 'video_genres', 'video_id', 'genre_id'
        )->using(VideoGenre::class);
    }
}
