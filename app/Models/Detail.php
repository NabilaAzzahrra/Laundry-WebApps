<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use HasFactory;

    protected $fillable = ['id_transaksi', 'id_paket', 'qty', 'keterangan'];

    protected $table = 'tb_detail_transaksi';

    public function pakets()
    {
        return $this->belongsTo(Paket::class, 'id_paket', 'id');
    }

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'kode_invoice', 'id_transaksi');
    }

    public function paket()
    {
        return $this->belongsTo(Paket::class, 'id_paket', 'id');
    }
}
