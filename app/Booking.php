<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'bookings';
    protected $primaryKey = 'id_booking';
    protected $fillable = ['id_resepsionis','id_tamu','id_kamar','tanggal_checkin','tanggal_checkout','total_bayar'];

    public function Resepsionis()
    {
        return $this->belongsTo(Resepsionis::class, 'id_resepsionis');
        
    }

    public function Tamu()
    {
        return $this->belongsTo(Tamu::class, 'id_tamu');
        
    }

    public function Room()
    {
        return $this->belongsTo(Room::class, 'id_kamar');
        
    }
}
