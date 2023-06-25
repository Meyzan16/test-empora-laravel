
@extends('Admin.layout.index')

@section('content')
<div id="main-content">
    <div class="page-heading">
    
        <div id="ajax-alert" class="alert"></div>
    
        <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Akun</h3>
            
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
                                        <th>Judul buku</th>
                                        <th>Tahun terbit</th>
                                        <th>Penulis</th>
                                        <th>Stok</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                
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
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- START FORM -->
                        <div class="alert alert-danger d-none"></div>
                        <div class="alert alert-success d-none"></div>

                        <div>
                            <h6 class="modal-title" id="exampleModalCenterTitle" aria-required="true"> judul buku  </h6>
                        <input type="text" class="form-control" name="judul_buku" id="judul_buku">
                        </div>
                        <div>
                            <h6 class="modal-title" id="exampleModalCenterTitle" aria-required="true"> tahun terbit  </h6>
                            <input type="text" class="form-control" name="tahun_terbit" id="tahun_terbit">
                        </div>
                    

                        <div>
                            <h6 class="modal-title" id="exampleModalCenterTitle" aria-required="true"> penulis  </h6>
                        <input type="text" class="form-control" name="penulis" id="penulis">
                        </div>
                    
                        <div>
                            <h6 class="modal-title" id="exampleModalCenterTitle" aria-required="true"> stok  </h6>
                            <input type="text" class="form-control" name="stok" id="stok">
                        </div>
                        
                      
                        <!-- AKHIR FORM -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary tombol-simpan">Simpan</button>
                    </div>
                </div>
            </div>
        </div>

        @push('prepend-script')
                
                <script>
                    $(document).ready(function() {
                        $('#myTable').DataTable({
                            processing: true,
                            serverside: true,
                            ajax: "{{ url('api/books') }}",
                            columns: [{
                                data: 'DT_RowIndex',
                                name: 'DT_RowIndex',
                                orderable: false,
                                searchable: false
                            }, {
                                data: 'judul_buku',
                                name: 'Judul Buku'
                            }, {
                                data: 'tahun_terbit',
                                name: 'Tahun tebrit'
                            }, {
                                data: 'penulis',
                                name: 'Penulis'
                            }, {
                                data: 'stok',
                                name: 'Stok'
                            }, {
                                data: 'aksi',
                                name: 'Aksi'
                            }]
                        });
                    });          
                    
                    //proses simpan
                    $('body').on('click', '.tombol-tambah', function(e) {
                        e.preventDefault();
                        $('#exampleModal').modal('show');
                        $('.tombol-simpan').click(function() {
                            simpan();
                        });
                    });

                    //proses edit
                    $('body').on('click', '.tombol-edit', function(e) {
                        var id = $(this).data('id');
                        $.ajax({
                            url: 'http://127.0.0.1:8000/api/books/' + id,
                            type: 'GET',
                            success: function(response) {
                                $('#exampleModal').modal('show');
                                $('#judul_buku').val(response.result.judul_buku);
                                $('#tahun_terbit').val(response.result.tahun_terbit);
                                $('#penulis').val(response.result.penulis);
                                $('#stok').val(response.result.stok);
                                console.log(response.result);
                                $('.tombol-simpan').click(function() {
                                    simpan(id);
                                });
                                
                            }
                        });

                    });


                     //delete
                     $('body').on('click', '.tombol-del', function(e) {
                        if (confirm('Yakin mau hapus data ini?') == true) {
                            var id = $(this).data('id');
                            $.ajax({
                                url: 'http://127.0.0.1:8000/api/books/' + id,
                                type: 'DELETE',
                                success: function(response) {
                                    if (response.success) {
                                        $('#ajax-alert').addClass('alert-success').show(function(){
                                            $(this).html(response.success);
                                        });
                                        setTimeout(function(){
                                            location.reload();
                                        },2000);
                                    }
                                    $('#myTable').DataTable().ajax.reload();
                                }
                            });
                            
                        }
                    });


                    function simpan(id = '') {  
                        if (id == '') {
                            var var_url = 'http://127.0.0.1:8000/api/books';
                            var var_type = 'POST';
                        } else {
                            var var_url = 'http://127.0.0.1:8000/api/books/' + id;
                            var var_type = 'PUT';
                        }

                        $.ajax({
                            url: var_url,
                            type: var_type,
                            data: {
                                judul_buku: $('#judul_buku').val(),
                                tahun_terbit: $('#tahun_terbit').val(),
                                penulis: $('#penulis').val(),
                                stok: $('#stok').val(),
                            },
                            success: function(response) {
                                if (response.errors) {
                                    console.log(response.errors);
                                    $('.alert-danger').removeClass('d-none');
                                    $('.alert-danger').html("<ul>");
                                    $.each(response.errors, function(key, value) {
                                        $('.alert-danger').find('ul').append("<li>" + value +
                                            "</li>");
                                    });
                                    $('.alert-danger').append("</ul>");
                                } else {
                                    $('.alert-success').removeClass('d-none');
                                    $('.alert-success').html(response.success);
                                }
                                $('#myTable').DataTable().ajax.reload();
                            }

                        });
                    }

                      
                    $('#exampleModal').on('hidden.bs.modal', function() {
                        $('#judul_buku').val('');
                        $('#tahun_terbit').val('');
                        $('#penulis').val('');
                        $('#stok').val('');
                        // $('#roles').val('');

                        $('.alert-danger').addClass('d-none');
                        $('.alert-danger').html('');

                        $('.alert-success').addClass('d-none');
                        $('.alert-success').html('');
                    });


                </script>
        @endpush

    
 

@endsection
