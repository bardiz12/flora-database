@extends('layouts.app')

@section('content')
<style>
.menu-button .btn{
    padding-top:20px;
    padding-bottom: 20px;
}
</style>

@include('admin.modal.show')
@include('admin.modal.add')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard Admin Database Flora</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <div class="row">
                            <div class="col-md-4">
                                <h4 class="text-center"><u>Informasi</u></h4>
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <tbody>
                                            @foreach ($totals as $k => $tot)
                                            <tr>
                                                    <td>{{$k}}</td>
                                                    <td>:</td>
                                                    <td>{{$tot}}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                            <div class="col-md-8">
                                <h4 class="text-center"><u>Status Konservasi</u></h4>
                                <div class="row">
                                    <div class="col-md-4">
                                        <h5>Undang - Undang</h5>
                                            <div class="table-responsive">
                                                    <table class="table table-hover">
                                                        <tbody>
                                                            <tr>
                                                                
                                                                <td>
                                                                    <i class="fa fa-arrow-right"></i> Dilindungi
                                                                </td>
                                                                <td >:</td>
                                                                <td>{{$status->uu->dilindungi}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td><i class="fa fa-arrow-right"></i> Tidak Dilindungi</td>
                                                                <td>:</td>
                                                                <td>{{$status->uu->tidak_dilindungi}}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                    </div>
                                    <div class="col-md-4">
                                        <h5>IUCN</h5>
                                            <div class="table-responsive">
                                                    <table class="table table-hover">
                                                        <tbody>
                                                            @foreach ($status->iucn as $item)
                                                            <tr>
                                                                <td>
                                                                    <i class="fa fa-arrow-right"></i> {{$item->name}}
                                                                </td>
                                                                <td >:</td>
                                                                <td>{{$item->floraStatusIUCN->count()}}</td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                    </div>
                                    <div class="col-md-4">
                                            <h5>CITES</h5>
                                                <div class="table-responsive">
                                                        <table class="table table-hover">
                                                            <tbody>
                                                                @foreach ($status->cites as $item)
                                                                <tr>
                                                                    <td>
                                                                        <i class="fa fa-arrow-right"></i> {{$item->name}}
                                                                    </td>
                                                                    <td >:</td>
                                                                    <td>{{$item->floraStatusCites->count()}}</td>
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                        </div>
                                </div>
                            </div>

                        </div>
        
                        <hr>
                        <div class="row menu-button">
                            <div class="col-md-4 mt-2">
                                <button class="btn btn-secondary btn-block" data-toggle="modal" data-target="#modal-show-data">
                                    <i class="fa fa-database d-block fa-3x"></i>
                                    Show Data
                                </button>
                            </div>
                            <div class="col-md-4 mt-2">
                                <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#modal-add-data">
                                    <i class="fa fa-plus d-block fa-3x"></i>
                                    Add Data
                                </button>
                            </div>
                            
                            <div class="col-md-4 mt-2">
                                <a class="btn btn-success btn-block" href="{{route('admin.import.index')}}">
                                    <i class="fa fa-download d-block fa-3x"></i>
                                    Import Data (csv)
                                </a>
                            </div>
                        </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
