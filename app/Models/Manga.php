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
        'body',
    ];

    public function chapters(): HasMany
    {
        return $this->hasMany(Chapter::class);
    }

}
