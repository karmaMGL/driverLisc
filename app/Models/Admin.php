<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authss;
use Illuminate\Notifications\Notifiable;

class Admin extends Authss
{
    use HasFactory , Notifiable;
    protected $fillable = [
        'email',
        'password',
        'phoneNumber',
    ];
    protected $hidden =[
        'password',
        'remember_token',
    ];
    protected $casts = [
        'password'=>'hashed',
    ];
}
