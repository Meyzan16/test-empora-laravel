<?php


namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Crypt;

class AkunController extends Controller
{
    public function index()
    {
        $data = user::orderBy('roles', 'asc');
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('aksi', function ($data) {
                return view('Admin.main.akun.tombol')->with('data', $data);
            })
            ->make(true);
    }

    public function store(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'name'=> 'required',
            'username'=> 'required|unique:users',
            'password'=> 'required',
            'email'=> 'required|unique:users',
        ], [
            'name.required'     => 'name wajib diisi',
            'username.required'     => 'username wajib diisi',
            'username.unique'     => 'username sudah terdaftar',
            'password.required'     => 'password wajib diisi',
            'email.required'     => 'email wajib diisi',
            'email.unique'     => 'email telah terdaftar ',
           
        ]);

        if ($validasi->fails()) {
            return response()->json(['errors' => $validasi->errors()]);
        } else {
            $data = [
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                // 'roles' => $request->roles,
            ];
            user::create($data);
            return response()->json(['success' => "Berhasil menyimpan data"]);
        }
    }

    public function show($id)
    {
        $data = user::where('id', $id)->first();
        return response()->json(['result' => $data]);
    }

    public function update(Request $request, $id)
    {
        $user = User::where('id',$id)->first();

        $validasi = Validator::make($request->all(), [
            'name'=> 'required',
            'username'=> 'required',
            'email'=> 'required',
        ], [
            'name.required'     => 'name wajib diisi',
            'username.required'     => 'username wajib diisi',
            'email.required'     => 'email wajib diisi',
        ]);

        if ($validasi->fails()) {
            return response()->json(['errors' => $validasi->errors()]);
        } else {
            $data = [
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => !isset($request->password) ? $user->password : bcrypt($request->password) ,
                'roles' => $request->roles,
            ];
            user::where('id', $id)->update($data);
            return response()->json(['success' => "Berhasil melakukan update data"]);
        }

    }


    public function destroy($id)
    {
        user::where('id', $id)->delete();
        return response()->json(['success' => "Data berhasil dihapus"]);
        // return redirect()->route('akun')->with('success', 'Data berhasil dihapus' );
    }

}
