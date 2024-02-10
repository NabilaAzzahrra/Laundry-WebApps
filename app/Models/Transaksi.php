<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = ['id_outlet', 'kode_invoice', 'id_member', 'tgl', 'batas_waktu', 'tgl_bayar', 'biaya_tambahan', 'diskon', 'pajak', 'status', 'dibayar', 'id_user'];

    protected $table = 'tb_transaksi';

    public function outlet()
    {
        return $this->belongsTo(Outlet::class, 'id_outlet', 'id');
    }

    public function member()
    {
        return $this->belongsTo(Member::class, 'id_member', 'id');
    }

    public function karyawan()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function details()
    {
        return $this->hasMany(Detail::class, 'id_transaksi', 'kode_invoice');
    }

    public function detailtransaksi()
    {
        return $this->hasMany(Detail::class, 'id_transaksi', 'kode_invoice');
    }
}
