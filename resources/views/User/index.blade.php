
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
                            <table class="table table-striped" id="myTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama buku</th>
                                        <th>Tanggal Peminjaman</th>
                                        <th>Tanggal Pengembalian</th>
                                        <th>Jumlah Pinjam</th>
                                        <th>Status pengajuan</th>
                                        <th>Status pengembalian</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($listLog as $item)
                                        
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->bukumodel->judul_buku}}</td>
                                        <td>{{ $item->tgl_peminjaman}}
                                        <td>{{ $item->tgl_pengembalian}}
                                        <td>{{ $item->jml_buku_pinjam}}
            
                                        @if ($item->status_pengajuan == 'N')
                                            <td>
                                                <span class="badge bg-warning">Menunggu Verifikasi</span>
                                            </td>
                                        @elseif($item->status_pengajuan == 'ditolak')
                                            <td>
                                                <span class="badge bg-danger">Ditolak</span>
                                            </td>
                                        @else
                                        <td>
                                            <span class="badge bg-success">disetujui</span>
                                        </td>
                                        @endif


                                        @if($item->status_pengajuan == 'Y')
                                            @if ($item->status_peminjaman == 'N')
                                                <td>
                                                    <span class="badge bg-warning">Menunggu Verifikasi</span>
                                                </td>
                                            @else
                                            <td>
                                                <span class="badge bg-success">disetujui</span>
                                            </td>
                                            @endif
                                        @elseif($item->status_pengajuan == 'ditolak')
                                            <td>
                                                <span class="badge bg-danger">tidak dilanjutkan</span>
                                            </td>
                                        @endif


                                        @if ($item->status_pengajuan == 'N')
                                            <td>
                                                <a href='#' data-id="{{ $item->id }}" class="btn btn-danger btn-sm tombol-del">Delete</a>
                                            </td>
                                        @else
                                        <td>
                                            <span class="badge bg-success">-</span>
                                        </td>
                                        @endif
                                        
                                    </tr>
                                    
                                    @endforeach
                                 
                                </tbody>
                                
                            </table>
                        </div>
                    </div>
        
                </section>
        </div>
</div>  

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Peminjaman</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('save-piminjaman') }}" method="POST">
                @csrf 
                <div class="modal-body">
                    <!-- START FORM -->
                    <div class="alert alert-danger d-none"></div>
                    <div class="alert alert-success d-none"></div>

                    <div>
                        <h6 class="modal-title" id="exampleModalCenterTitle" aria-required="true"> Buku  </h6>
                        <select name="id_kode_buku" class="form-control">
                            <option value=""> -- Pilih Buku -- </option>  
                            @foreach ($buku as $item)
                                <option value="{{ $item->kode_buku}}"> {{ $item->judul_buku}}</option>  
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <h6 class="modal-title" id="exampleModalCenterTitle" aria-required="true"> Tanggal peminjaman  </h6>
                        <input type="date" class="form-control" name="tgl_peminjaman" id="tgl_peminjaman">
                    </div>

                    <div>
                        <h6 class="modal-title" id="exampleModalCenterTitle" aria-required="true"> Tanggal pengembalian  </h6>
                        <input type="date" class="form-control" name="tgl_pengembalian" id="tgl_pengembalian">
                    </div>
                

                    <div>
                        <h6 class="modal-title" id="exampleModalCenterTitle" aria-required="true"> Jumlah dipinjam  </h6>
                        <input type="number" class="form-control" name="jml_buku_pinjam" id="jml_buku_pinjam">
                    </div>
                
                    <!-- AKHIR FORM -->
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary tombol-simpan">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

    
@endsection


 

