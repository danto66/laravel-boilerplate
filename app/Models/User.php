<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use App\Models\Traits\Searchable;
use Illuminate\Notifications\Notifiable;
use App\Models\Traits\WithUnixTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    use WithUnixTimestamps;
    use Searchable, Filterable;

    protected $fillable = [
        'name',
        'email',
        'gender',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
