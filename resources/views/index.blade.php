
@extends('admin.layout.index')

@section('content')
<div id="main-content">
<div class="page-heading">
    <h3>Data pribadi</h3>
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
                                    <div class="table-responsive">
                                        <table class="table table-lg">
                                            
                                            <tbody>
                                                <tr>
                                                    <td class="text-bold-500">Nama</td>
                                                    <td class="text-bold-500">{{auth()->user()->name}}</td>

                                                </tr>
                                                <tr>
                                                    <td class="text-bold-500">Email</td>
                                                    <td class="text-bold-500">{{auth()->user()->email}}</td>

                                                </tr>
                                                <tr>
                                                    <td class="text-bold-500">Username</td>
                                                    <td class="text-bold-500">{{auth()->user()->username}}</td>

                                                </tr>
                                               
                                            </tbody>
                                        </table>
                                </div>
                            </div>

                           
                        
                        
                        </div>

                    
                    
                    </div>

                </section>
            </div>
    
@endsection


 

