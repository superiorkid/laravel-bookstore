<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    /** @use HasFactory<\Database\Factories\BookFactory> */
    use HasFactory;

    public function category(): BelongsTo {
        return $this->belongsTo(BookCategory::class);
    }

    public function author(): BelongsTo {
        return $this->belongsTo(Author::class);
    }

    public function ratings(): HasMany {
        return $this->hasMany(Rating::class);
    }

    public function getAverageRatingAttribute() {
        return $this->ratings()->avg('rating');
    }
}
