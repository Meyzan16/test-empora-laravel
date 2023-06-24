<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequestController extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        
        if(request()->isMethod('post')){
            return [
                'judul_buku' => 'required',
                'tahun_terbit' => 'required',
                'penulis' => 'required',
                'stok' => 'required',
                ];
        }else{
            return [
                'judul_buku' => 'required',
                'tahun_terbit' => 'required',
                'penulis' => 'required',
                'stok' => 'required',
                ];

        }
    }

    public function messages()
    {
        if(request()->isMethod('post')){
            return [
                'judul_buku.required' => 'Judul buku wajib diisi',
                'tahun_terbit.required' => 'Tahun terbit buku wajib diisi',
                'penulis.required' => 'Penulis buku wajib diisi',
                'stok.required' => 'Stok buku wajib diisi',
                ];
        }else{
            return [
                'judul_buku.required' => 'Judul buku wajib diisi',
                'tahun_terbit.required' => 'Tahun terbit buku wajib diisi',
                'penulis.required' => 'Penulis buku wajib diisi',
                'stok.required' => 'Stok buku wajib diisi',
                ];

        }
    }
}
