<?php

namespace App\Models;

use App\Models\Scopes\CustomerScope;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends User
{
    use HasFactory;

    protected $table = 'users';

    protected static function booted(): void
    {
        static::addGlobalScope(new CustomerScope);
    }

    protected function model(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => Customer::class,
        );
    }

    public function url(): string
    {
        return env('APP_URL');
    }
}
