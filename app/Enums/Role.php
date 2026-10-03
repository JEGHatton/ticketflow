<?php

namespace App\Enums;

enum Role: string
{
    case Customer = 'customer';
    case Agent = 'agent';
    case Admin = 'admin';

    public function label(): string
    {
        return match ($this) {
            self::Customer => 'Customer',
            self::Agent => 'Agent',
            self::Admin => 'Admin',
        };
    }
}