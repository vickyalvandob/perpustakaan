<?php

namespace App\Models;

use App\Enums\BookStatus;
use App\Enums\BookLanguage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

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

    
    public function scopeFilter(Builder $query, array $filters): void
    {
        $query->when($filters['search'] ?? null, function($query, $search){
            $query->where(function ($query) use ($search) {
                $query->whereAny([
                'book_code',
                'slug',
                'title',
                'author',
                'publication_year',
                'isbn',
                'language',
                'status',
                ], 'REGEXP', $search);
            });
        });
    }

    public function scopeSorting(Builder $query, array $sorts): void
    {
        $query->when($sorts['field'] ?? null && $sorts['direction'] ?? null, function ($query) use ($sorts) {
            $query->orderBy($sorts['field'], $sorts['direction']);
        });
    }
}
