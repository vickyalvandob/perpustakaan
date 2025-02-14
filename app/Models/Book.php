<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\BookLanguage;
use App\Enums\BookStatus;

class Book extends Model
{
    protected $fillable = [
        'book_code',
        'slug',
        'title',
        'author',
        'publication',
        'isbn',
        'language',
        'synopsis',
        'status',
        'number_of_pages',
        'cover',
        'price',
        'category_id',
        'publisher_id'
    ];

    protected function casts(): array
    {
        return [
            'language' =>  BookLanguage::class,
            'status' =>  BookStatus::class,
        ];
    }


    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function stock(): HasOne
    {
        return $this->hasOne(Stock::class);
    }

    public function loans(): HasMany
    {
        return $this->hasMany(Loan::class);
    }

    public function publisher(): BelongsTo
    {
        return $this->belongsTo(Publisher::class);
    }
}
