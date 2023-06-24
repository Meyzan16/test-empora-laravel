
@extends('admin.layout.index')

@section('content')
<div id="main-content">
    <div class="page-heading">
    
        <div id="ajax-alert" class="alert"></div>
    
        <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>List Pengajuan Buku</h3>
            
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Akun</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Data</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <div class="div">
                    @if (count($errors) > 0)
                                <div class="alert alert-danger autohide">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                </div>
        
                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            <button type="button" class="mr-3 btn btn-outline-primary block tombol-tambah"
                            data-bs-toggle="modal" data-bs-target="#exampleModal">
                            &nbsp;Tambah Data
                            </button>
                        </div>
        
                        <div class="card-body">
                            <table class="table table-striped" id="table1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Peminjama</th>
                                        <th>Nama buku</th>
                                        <th>Tanggal Peminjaman</th>
                                        <th>Tanggal Pengembalian</th>
                                        <th>Jumlah Pinjam</th>
                                        <th>Status Pengajuan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($listLog as $item)
                                        
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->user_pengguna->name}}</td>
                                        <td>{{ $item->bukumodel->judul_buku}}</td>
                                        <td>{{ $item->tgl_peminjaman}}
                                        <td>{{ $item->tgl_pengembalian}}
                                        <td>{{ $item->jml_buku_pinjam}}
            
                                        @if ($item->status_pengajuan == 'N')
                                            <td>
                                                <span class="badge bg-danger">Menunggu Verifikasi</span>
                                            </td>
                                        @else
                                        <td>
                                            <span class="badge bg-success">disetujui</span>
                                        </td>
                                        @endif
                             

                                        <td>
                                            <a class="badge bg-success"   data-bs-toggle="modal" data-bs-target="#exampleModalTerima{{ $item->id }}">   <i class="fa fa-check-circle"> </i>  </a>
                                        </td>
                 
                                    </tr>
                                    
                                    @endforeach
                                 
                                </tbody>
                                
                            </table>
                        </div>
                    </div>
        
                </section>
        </div>
</div> 

@foreach($listLog as $item1)
<div class="modal fade" id="exampleModalTerima{{$item1->id}}" tabindex="-1" role="dialog"
aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable"
    role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle"> Validasi Disetujui {{ $item1->user_pengguna->name}}
            </h5>
            <button type="button" class="close" data-bs-dismiss="modal"
                aria-label="Close">
                <i data-feather="x"></i>
            </button>
        </div>

        <form action="{{ route('verif_pengajuan_diterima', $item1->id) }}" method="POST">
            @csrf {{ method_field('PATCH') }}


            <div class="modal-body">
                <p class="text-center">
                    Perhatian !!!
                    Silahkan cek data peminjaman dengan benar
                </p>


                
            </div>
            <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary"
                        data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Kembali</span>
                    </button>

                    <button type="submit" class="btn btn-primary ml-1">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block" >Verifikasi</span>
                    </button>

                    
                
            </div>
        </form>
    </div>
</div>
</div>
@endforeach




    
@endsection


 

