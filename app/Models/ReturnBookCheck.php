<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\ReturnBookCondition;

class ReturnBookCheck extends Model
{
    protected $fillable = [
        'return_book_id',
        'condition',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'condition' => ReturnBookCondition::class,
        ];
    }

}
