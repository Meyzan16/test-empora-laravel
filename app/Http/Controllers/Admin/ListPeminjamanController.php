<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BukuModel;
use App\Models\LogPengajuanModel;
use Illuminate\Support\Facades\Validator;

class ListPeminjamanController extends Controller
{
    public function index()
    {
        $listLog = LogPengajuanModel::where('status_pengajuan', 'N')->orWhere('status_pengajuan', 'ditolak')->get();
        
        return view('Admin.main.Listpengajuan', [
            'listLog' => $listLog,
        ]);
    }

    public function listpeminjaman()
    {
        $listLog = LogPengajuanModel::where('status_pengajuan', 'Y')->get();
        
        return view('Admin.main.Listpeminjaman', [
            'listLog' => $listLog,
        ]);
    }

    public function verifikasi_pengajuan($id)
    {   
        $stok = '';

        $ambilPengajuan = LogPengajuanModel::where('id', $id)->first();

        $ambilstok = BukuModel::where('kode_buku',$ambilPengajuan->id_kode_buku)->first();

        if($ambilstok->stok > $ambilPengajuan->jml_buku_pinjam){
                $stok =  $ambilstok->stok - $ambilPengajuan->jml_buku_pinjam;
        }else{
            return redirect()->route('list-pengajuan-admin')->with('error', 'stok tidak cukup dan stok tersisa '. $ambilstok->stok);
        }

        BukuModel::where('kode_buku', $ambilPengajuan->id_kode_buku)->update([
            'stok' => $stok
        ]);

        LogPengajuanModel::where('id', $id)->update([
            'id_admin' => auth()->user()->id,
            'status_pengajuan' => 'Y'
        ]);


        return redirect()->route('list-pengajuan-admin')->with('success', 'Pengajuan buku berhasil diverifikasi');
    }

    public function verifikasi_pengajuan_tolak($id)
    {   
        

        LogPengajuanModel::where('id', $id)->update([
            'id_admin' => auth()->user()->id,
            'status_pengajuan' => 'ditolak'
        ]);

       
        return redirect()->route('list-pengajuan-admin')->with('success', 'Pengajuan buku berhasil ditolak');
    }


    public function verifikasi_pengembalian($id)
    {   
        LogPengajuanModel::where('id', $id)->update([
            'id_admin' => auth()->user()->id,
            'status_peminjaman' => 'Y'
        ]);


        $stok = '';

        $ambilPengajuan = LogPengajuanModel::where('id', $id)->first();

        $ambilstok = BukuModel::where('kode_buku',$ambilPengajuan->id_kode_buku)->first();

        $stok =  $ambilstok->stok + $ambilPengajuan->jml_buku_pinjam;
        

        BukuModel::where('kode_buku', $ambilPengajuan->id_kode_buku)->update([
            'stok' => $stok
        ]);


        return redirect()->route('list-peminjaman-admin')->with('success', 'Pengambalian buku berhasil diverifikasi');
    }
}
