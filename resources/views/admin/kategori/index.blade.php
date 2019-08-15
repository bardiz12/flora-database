@extends('layouts.app')

@section('content')
<style>
.menu-button .btn{
    padding-top:20px;
    padding-bottom: 20px;
}
</style>
@include('admin.kategori.modal.store')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <span>Data Kategori Flora</span>
                    <a href="{{route('admin.kategori.create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Add Data</a>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('msg'))
                        <div class="alert alert-{{session('msg-status')}}" role="alert">
                            {{ session('msg') }}
                        </div>
                    @endif
                        <div class="row">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="thead-dark">
                                        <tr class="text-center">
                                            <th style="width:10px;">#</th>
                                            <th>Nama</th>
                                            <th>Description</th>
                                            <th>Jumlah Flora</th>
                                            <th>Terdaftar</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($data as $item)
                                            <tr class="text-center">
                                                <td>{{$item->id}}</td>
                                                <td>{{$item->name}}</td>
                                                <td>{{$item->description}}</td>
                                                <td>{{$item->flora->count()}}</td>
                                                <td>
                                                    @if($item->trashed())
                                                        <span class="badge badge-danger">No</span>
                                                    @else
                                                        <span class="badge badge-success">Yes</span>
                                                    @endif
                                                </td>
                                                <td>
                                                        <div class="dropdown show">
                                                            <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="fa fa-wrench"></i>
                                                            </a>
                                                            
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                                <button class="dropdown-item btn-edit" type="button" data-json='{!! $item->toJson() !!}'><i class="fa fa-pencil"></i> Edit</button>
                                                                <a class="dropdown-item" href="{{route('admin.kategori.trash',$item->id)}}"><i class="fa fa-trash"></i> @if($item->trashed())
                                                                    Add to List
                                                                @else
                                                                    Remove From List
                                                                @endif</a>
                                                            </div>
                                                            </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            
                        </div>
                        <div class="d-flex justify-content-center">
                                
                            </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
    $(".btn-edit").click(function(e){
        var data = $(this).data('json');
        console.log(data);
        $("#modal-store-data").modal('toggle');

        for(var key in data){
            $($("#modal-store-data").find('#'+key)).val(data[key]);
        }
        if(data.status_uu_id){
            $($("#modal-store-data").find('#status_uu_id_ya')).prop("checked",true);
        }else{
            $($("#modal-store-data").find('#status_uu_id_tidak')).prop("checked",true);
        }
    
    })
});
</script>
@endsection
