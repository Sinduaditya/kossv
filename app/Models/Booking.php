<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'id_kamar', 'tanggal_pemesanan', 'tanggal_berakhir', 'status_pembayaran', 'kode_booking'];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'user_id');
    }

    // Relasi ke Room (satu booking hanya untuk satu kamar)
    public function room()
    {
        return $this->belongsTo(Room::class, 'id_kamar');
    }

    // Relasi ke Payment (satu booking memiliki satu pembayaran)
    public function payment()
    {
        return $this->hasOne(Payment::class, 'id_pemesanan');
    }
}
