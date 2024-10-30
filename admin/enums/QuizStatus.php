<?php

namespace admin\enums;

use common\enums\{DictionaryInterface, DictionaryTrait};

/**
 * Class QuizStatus
 *
 * @package admin\enums
 * @author m.kropukhinsky <m.kropukhinsky@peppers-studio.ru>
 */
enum QuizStatus: int implements DictionaryInterface
{
    use DictionaryTrait;

    case Canceled = 0;
    case New = 10;
    case Completed = 20;

    /**
     * {@inheritdoc}
     */
    public function description(): string
    {
        return match ($this) {
            self::Canceled => 'Отменено',
            self::New => 'Новый',
            self::Completed => 'Завершено'
        };
    }

    /**
     * {@inheritdoc}
     */
    public function color(): string
    {
        return match ($this) {
            self::Canceled => 'var(--bs-body-color)',
            self::New => 'var(--bs-success)',
            self::Completed => 'var(--bs-success)',
        };
    }
}
