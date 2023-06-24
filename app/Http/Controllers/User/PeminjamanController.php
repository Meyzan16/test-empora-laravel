<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BukuModel;
use App\Models\LogPengajuanModel;
use Illuminate\Support\Facades\Validator;

class PeminjamanController extends Controller
{
    public function index()
    {
        $buku = BukuModel::all();
        $listLog = LogPengajuanModel::where('id_pengguna', auth()->user()->id)->get();
        
        return view('User.index', [
            'buku' => $buku,
            'listLog' => $listLog,
        ]);
    }

    public function pengajuan(request $request)
    {

        $rules = [
            'id_kode_buku'=> 'required',
            'tgl_peminjaman'=> 'required',
            'tgl_pengembalian'=> 'required',
            'jml_buku_pinjam'=> 'required',
        ];
        $messages = [
            'id_kode_buku.required'     => 'buku wajib diisi',
            'tgl_peminjaman.required'     => 'tanggal peminjaman wajib diisi',
            'tgl_pengembalian.required'     => 'tanggal pengembalian wajib diisi',
            'jml_buku_pinjam.required'     => 'jumlah pinjam wajib diisi',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        //jika rules tidak sesuai kembalikan ke login bawak pesan error dan bawak request nya agar bisa dipakai denga old di view
        if($validator->fails())
        {           
                return redirect()->back()->withErrors($validator)->withInput($request->all());
        } 
        else{
            
            LogPengajuanModel::create([
                'id_kode_buku' => $request->id_kode_buku,
                'id_pengguna' => auth()->user()->id,
                'tgl_peminjaman' => $request->tgl_peminjaman,
                'tgl_pengembalian' => $request->tgl_pengembalian,
                'jml_buku_pinjam' => $request->jml_buku_pinjam,
            ]);
        }

        return redirect()->route('pengajuan')->with('success', 'Pengajuan peminjaman berhasil');

    }

    public function destroy(request $request)
    {   

        $id = $request->id_delete;
        $data = LogPengajuanModel::where('id', $id)->first();

        if($data->status_pengajuan == 'Y')
        {
            $ambilstok = BukuModel::where('kode_buku', $data->id_kode_buku)->first();
            BukuModel::where('kode_buku', $data->id_kode_buku)->update([
                'stok' => $ambilstok->stok + $data->jml_buku_pinjam
            ]);
        }


        LogPengajuanModel::where([
            ['id', '=',  $data->id],
        ])->delete();

        return redirect()->route('pengajuan')->with('success', 'Pengajuan buku berhasil dihapus');



    }

}
