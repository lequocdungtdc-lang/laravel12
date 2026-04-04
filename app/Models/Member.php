<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Member extends Authenticatable
{
    protected $table = 'members';

    protected $fillable = [
        'fullname',
        'phone',
        'email',
        'address',
        'id_group',
        'password', // ⚠️ THIẾU cái này
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed', // OK giữ lại
        ];
    }
}