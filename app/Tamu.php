<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tamu extends Model
{
    protected $table = 'tamus';
    protected $primaryKey = 'id_tamu';
    protected $fillable = ['nama_tamu','gender','alamat','no_telp'];
}
