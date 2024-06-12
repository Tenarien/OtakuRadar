<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Chapter extends Model
{
    use HasFactory;

    protected $fillable = [
      'manga_id',
      'chapter_number',
    ];
    public function manga(): BelongsTo
    {
        return $this->belongsTo(Manga::class);
    }

    public function links(): HasMany
    {
        return $this->hasMany(Link::class);
    }
}
