<?php

namespace App\Enums;

enum StatusEnum: string
{
    case NEW = 'new';
    case PROCESSING = 'processing';
    case COMPLETED = 'completed';
    case CANCELED = 'canceled';

    public function label(): string
    {
        return match($this) {
            self::NEW => 'Новый',
            self::PROCESSING => 'В обработке',
            self::COMPLETED => 'Завершен',
            self::CANCELED => 'Отменен',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
