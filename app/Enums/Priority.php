<?php

namespace App\Enums;

enum Priority: string
{
    case P1 = 'p1';
    case P2 = 'p2';
    case P3 = 'p3';
    case P4 = 'p4';

    public function label(): string
    {
        return match ($this) {
            self::P1 => 'P1 Critical',
            self::P2 => 'P2 High',
            self::P3 => 'P3 Medium',
            self::P4 => 'P4 Low',
        };
    }
}
