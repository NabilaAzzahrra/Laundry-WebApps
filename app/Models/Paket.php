<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    use HasFactory;

    protected $fillable = ['id_outlet', 'jenis', 'nama_paket', 'harga'];

    protected $table = 'tb_paket';

    public function outlet()
    {
        return $this->belongsTo(Outlet::class, 'id_outlet', 'id');
    }

    public function details(){
        return $this->hasMany(Transaksi::class, 'id_paket');
    }

    public function detailtransaksi()
    {
        return $this->hasMany(Detail::class, 'id_paket', 'id');
    }
}
