<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\LogPengajuanModel;

class BukuModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul_buku', 'tahun_terbit','penulis', 'stok'
    ];

    public function LogPengajuanModel()
    {
        return $this->hasMany(LogPengajuanModel::class);
    }


}
