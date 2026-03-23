<?php

declare(strict_types=1);

namespace App\Presenter;

use DateTimeInterface;

class DateFormatPresenter
{
    public function present(DateTimeInterface $date): array
    {
        return [
            'timestamp' => $date->getTimestamp(),
            'iso' => $date->format(DateTimeInterface::ATOM),
            'formatted' => $date->format('d/m/Y H:i'),
        ];
    }
}
