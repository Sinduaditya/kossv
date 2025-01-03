<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    use HasFactory;
    protected $fillable = ['nama', 'email', 'password', 'no_telepon', 'alamat'];

    protected $hidden = ['password'];

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'user_id');
    }
}
