<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $fillable = ['gambar', 'tipe_kamar', 'harga', 'status_ketersediaan', 'deskripsi', 'date_added'];

    // Relationship to bookings
    public function bookings()
    {
        return $this->hasMany(Booking::class, 'id_kamar');
    }

}
