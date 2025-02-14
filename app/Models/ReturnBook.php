<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\ReturnBookStatus;

class ReturnBook extends Model
{
    protected $fillable = [
        'book_id',
        'return_book_code',
        'loan_id',
        'user_id',
        'return_date',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'return_date' => 'date',
            'status' => ReturnBookStatus::class,
        ];
    }

    public function loan(): BelongsTo
    {
        return $this->belongsTo(Loan::class);
    }

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    public function fine(): HasOne
    {
        return $this->hasOne(Fine::class);
    }

    public function returnBookCheck(): HasOne
    {
        return $this->hasOne(ReturnBookCheck::class);
    }
}
