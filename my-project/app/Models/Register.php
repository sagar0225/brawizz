<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use Laravel\Passport\HasApiTokens;

class Register extends Model
{
    use HasFactory;
    protected $table='registers';
    protected $fillable=['name','email','mobile','password'];
    use  Notifiable;
}
