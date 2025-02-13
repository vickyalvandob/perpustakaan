<?php

namespace App\Enums;

enum FindPaymentStatus: string
{
    case PENDING = 'Tertunda';
    case SUCCESS = 'Sukses';
    case FAILED = 'Gagal';

    public static function options(): array
    {
        return collect(self::cases())->map(fn($item) => [
            'value' => $items->value,
            'label' => $item->value,
        ])->values()->toArray();
    }
}