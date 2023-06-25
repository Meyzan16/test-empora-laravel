
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
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Username</th>
                                        <th>Roles</th>
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
                            <h6 class="modal-title" id="exampleModalCenterTitle" aria-required="true"> NAMA  </h6>
                        <input type="text" class="form-control" name="name" id="name">
                        </div>
                        <div>
                            <h6 class="modal-title" id="exampleModalCenterTitle" aria-required="true"> EMAIL  </h6>
                            <input type="text" class="form-control" name="email" id="email">
                        </div>
                    

                        <div>
                            <h6 class="modal-title" id="exampleModalCenterTitle" aria-required="true"> USERNAME  </h6>
                        <input type="text" class="form-control" name="username" id="username">
                        </div>
                    
                        <div>
                            <h6 class="modal-title" id="exampleModalCenterTitle" aria-required="true"> PASSWORD  </h6>
                            <input type="text" class="form-control" name="password" id="password">
                        </div>
                        
                        <div>
                            <h6 class="modal-title" id="exampleModalCenterTitle" aria-required="true"> STATUS AKUN  </h6>
                            <select name="roles" id="roles" class="form-control" >
                                <option value=""> --pilih data--</option>
                                <option value="0">PENGGUNA</option>
                                <option value="1">ADMIN</option>
                            </select>
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
                            ajax: "{{ url('admin/master/akunAjax') }}",
                            columns: [{
                                data: 'DT_RowIndex',
                                name: 'DT_RowIndex',
                                orderable: false,
                                searchable: false
                            }, {
                                data: 'name',
                                name: 'Nama'
                            }, {
                                data: 'email',
                                name: 'Email'
                            }, {
                                data: 'username',
                                name: 'Username'
                            }, {
                                data: 'roles',
                                name: 'Roles'
                            },  {
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
                            url: 'akunAjax/' + id + '/edit',
                            type: 'GET',
                            success: function(response) {
                                $('#exampleModal').modal('show');
                                $('#name').val(response.result.name);
                                $('#email').val(response.result.email);
                                $('#username').val(response.result.username);
                                $('#password').val(response.enkrip);
                                $('#roles').val(response.result.roles);
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
                                url: 'akunAjax/' + id,
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
                            var var_url = 'akunAjax';
                            var var_type = 'POST';
                        } else {
                            var var_url = 'akunAjax/' + id;
                            var var_type = 'PUT';
                        }

                        $.ajax({
                            url: var_url,
                            type: var_type,
                            data: {
                                name: $('#name').val(),
                                email: $('#email').val(),
                                username: $('#username').val(),
                                password: $('#password').val(),
                                roles: $('#roles').val()
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
                        $('#nama').val('');
                        $('#email').val('');
                        $('#username').val('');
                        $('#password').val('');
                        // $('#roles').val('');

                        $('.alert-danger').addClass('d-none');
                        $('.alert-danger').html('');

                        $('.alert-success').addClass('d-none');
                        $('.alert-success').html('');
                    });


                </script>
        @endpush

    
 

@endsection
