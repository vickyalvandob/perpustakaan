<?php

namespace App\Enums;

enum ReturnBookCondition: string
{
    case GOOD = 'Sesuai';
    case DAMAGED = 'Rusak';
    case LOST = 'Hilang';

    public static function options(): array
    {
        return collect(self::cases())->map(fn($item) => [
            'value' => $items->value,
            'label' => $item->value,
        ])->values()->toArray();
    }
}