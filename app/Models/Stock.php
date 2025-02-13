<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = [
        'book_id',
        'total',
        'available',
        'loan',
        'lost',
        'damaged',
    ];
}
