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

    public function views()
    {
        return $this->hasMany(ChapterView::class);
    }

    public function links(): HasMany
    {
        return $this->hasMany(Link::class);
    }

    public function nextChapter()
    {
        return $this->manga->chapters()
            ->where('id', '>', $this->id)
            ->orderBy('id', 'asc')
            ->first();
    }

    public function previousChapter()
    {
        return $this->manga->chapters()
            ->where('id', '<', $this->id)
            ->orderBy('id', 'desc')
            ->first();
    }

    public function nextLinkUrl()
    {
        $nextChapter = $this->nextChapter();
        return $nextChapter ? $nextChapter->links->first()?->url : null;
    }

    public function previousLinkUrl()
    {
        $previousChapter = $this->previousChapter();
        return $previousChapter ? $previousChapter->links->first()?->url : null;
    }

    public function chapterViews()
    {
        return $this->hasMany(ChapterView::class);
    }


    public function wasViewedByUser($userId)
    {
        return $this->chapterViews()->where('user_id', $userId)->exists();
    }
}
