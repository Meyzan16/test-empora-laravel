
@extends('admin.layout.index')

@section('content')
<div id="main-content">
<div class="page-heading">
    <h3>Profile Statistics</h3>
</div>
        
                            @if(session()->has('success'))
                                
                                    <div class="alert alert-success autohide" role="alert">
                                    {{ session('success') }}
                                    </div>    
                              
                            @endif 

            <div class="page-content">
                <section class="row">
                    <div class="col-12 col-lg-12">
                        <div class="row">
                            <div class="col-12 col-lg-6 col-md-12">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon purple">
                                                    <i class="iconly-boldShow"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Jumlah Buku</h6>
                                                {{-- <h6 class="font-extrabold mb-0">{{ $jml_titik }}</h6> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6 col-md-12">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon blue">
                                                    <i class="iconly-boldProfile"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Jumlah pengguna </h6>
                                                {{-- <h6 class="font-extrabold mb-0">{{ count($data_gempa) }}</h6> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                        
                        </div>

                    
                    
                    </div>

                </section>
            </div>
    
@endsection


 

