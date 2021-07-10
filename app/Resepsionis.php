<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resepsionis extends Model
{
    protected $table = 'resepsionis';
    protected $primaryKey = 'id_resepsionis';
    protected $fillable = ['nama_resepsionis','umur','alamat','no_telp'];
}
