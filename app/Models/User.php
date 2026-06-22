<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

  protected $fillable = [
    'name',
    'email',
    'username', // Asegúrate de que esté aquí
    'password',
    'rol',      // Asegúrate de que esté aquí
];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}