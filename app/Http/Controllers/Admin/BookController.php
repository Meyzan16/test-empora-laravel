<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BukuModel;
use App\Http\Requests\BookRequestController;
use App\Http\Resources\ProjectResource;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class BookController extends Controller
{
    public function index()
    {
        $data = BukuModel::all();
        return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('aksi', function ($data) {
            return view('Admin.main.books.tombol')->with('data', $data);
        })
        ->make(true);
    }

    public function store(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'judul_buku'=> 'required',
            'tahun_terbit'=> 'required',
            'penulis'=> 'required',
            'stok'=> 'required',
            
        ], [
            'judul_buku.required'     => 'judul buku wajib diisi',
            'tahun_terbit.required'     => 'tahun terbit wajib diisi',
            'penulis.required'     => 'penulis wajib diisi',
            'stok.required'     => 'stok buku wajib diisi',
            'stok.required'     => 'stok buku wajib diisi',
        
           
        ]);
        if ($validasi->fails()) {
            return response()->json(['errors' => $validasi->errors()]);
        } else {
            $data = [
                'judul_buku' => $request->judul_buku,
                'tahun_terbit' => $request->tahun_terbit,
                'penulis' => $request->penulis,
                'stok' => $request->stok,
                // 'roles' => $request->roles,
            ];
            $project = BukuModel::create($data);
    
            return response(['books' => new ProjectResource($project), 'success' => 'Created successfully'], 201);
        }
    }

    public function show($id)
    {
        $data = BukuModel::where('kode_buku', $id)->first();
        return response()->json(['result' => $data],201);
       
    }

    public function update(Request $request, $id)
    {
        $data = [
            'judul_buku' => $request->judul_buku,
            'tahun_terbit' => $request->tahun_terbit,
            'penulis' => $request->penulis,
            'stok' => $request->stok,
        ];

        BukuModel::where('kode_buku', $id)->update($data);

        $project = BukuModel::where('kode_buku', $id)->first();

        return response([ 'books' => new ProjectResource($project) , 'success' => 'Updated successfully'], 200);
    }

    public function destroy($id)
    {
        BukuModel::where('kode_buku', $id)->delete();

        return response(['success' => 'Deleted successfully']);
    }
}
