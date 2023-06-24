<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BukuModel;
use App\Models\User;

class LogPengajuanModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_kode_buku', 'id_pengguna','tgl_peminjaman', 'tgl_pengembalian','jml_buku_pinjam'
    ];

    public function bukumodel()
    {
        return $this->belongsTo(BukuModel::class, 'id_kode_buku', 'kode_buku');
    }

    public function user_pengguna()
    {
        return $this->belongsTo(User::class, 'id_pengguna', 'id');
    }

    public function user_persetujuan()
    {
        return $this->belongsTo(User::class, 'id_admin', 'id');
    }

    
}
