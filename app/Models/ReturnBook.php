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
}
