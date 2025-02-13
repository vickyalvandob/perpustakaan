<?php

namespace App\Enums;

enum BookLanguage: string
{
    case ENGLISH = 'English';
    case INDONESIA = 'Indonesia';
    case JAPAN = 'Jepang';

    public static function options(): array
    {
        return collect(self::cases())->map(fn($item) => [
            'value' => $items->value,
            'label' => $item->name,
        ])->values()->toArray();
    }
}