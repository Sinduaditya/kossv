<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = ['id_pemesanan', 'metode_pembayaran', 'tanggal_pemesanan', 'jumlah_pembayaran','link_pembayaran'];

     // Relationship to booking
     public function booking()
     {
         return $this->belongsTo(Booking::class, 'id_pemesanan');
     }
}
