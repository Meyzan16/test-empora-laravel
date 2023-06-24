<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BukuModel;
use Exception;
use App\Http\Requests\BookRequestController;

class BookController extends Controller
{
    public function index()
    {
        $data = BukuModel::all();

        return response()->json([
            'books' => $data
        ],200);
    }

    public function store(BookRequestController $request){
        try{
            BukuModel::create([
                'judul_buku' => $request->judul_buku,
                'tahun_terbit' => $request->tahun_terbit,
                'penulis' => $request->penulis,
                'stok' => $request->stok,
            ]);

            return response()->json([
                'message' => 'Book succesfully created'
            ],200);

        }catch(Exception $e){
            return response()->json([
                'message' => 'Something created books'
            ]);
        }
    }
}
