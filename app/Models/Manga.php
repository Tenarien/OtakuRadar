<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Manga extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
        'url',
        'source_website',
    ];

    public function chapters(): HasMany
    {
        return $this->hasMany(Chapter::class);
    }

    public function follow(User $user)
    {
        $this->followers()->attach($user);
    }

    public function unfollow(User $user)
    {
        $this->followers()->detach($user);
    }

    public function isFollowedBy(User $user)
    {
        return $this->followers()->where('user_id', $user->id)->exists();
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'manga_user')->withTimestamps();
    }

}
