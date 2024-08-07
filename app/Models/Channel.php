<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Channel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'name_mm', 'description', 'image_path', 'status',
    ];

    // public function videos(): BelongsToMany
    // {
    //     return $this->belongsToMany(Video::class, 'channel_video', 'channel_id', 'video_id');
    // }

    public function video(): HasOne
    {
        return $this->hasOne(Video::class);
    }

    public function videos(): HasMany
    {
        return $this->hasMany(Video::class);
    }
}
