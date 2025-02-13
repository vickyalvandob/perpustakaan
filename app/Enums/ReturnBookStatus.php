<?php

namespace App\Enums;

enum ReturnBookStatus: string
{
    case RETURNED = 'Dikembalikan';
    case CHECKED = 'Pengecekan';
    case FINE = 'Denda';

    public static function options(): array
    {
        return collect(self::cases())->map(fn($item) => [
            'value' => $items->value,
            'label' => $item->label,
        ])->values()->toArray();
    }
}