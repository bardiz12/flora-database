@extends('layouts.app')

@section('content')
<style>
.menu-button .btn{
    padding-top:20px;
    padding-bottom: 20px;
}
.alt-text-input{
    border-radius: 0px;
    margin-bottom: 2px;
}
</style>
@include('plugins.lfm-image')
@include('admin.flora.modal.store')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <span>Data Flora</span>
                    <a href="{{route('admin.flora.create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Add Data</a>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('msg'))
                        <div class="alert alert-{{session('msg-status')}}" role="alert">
                            {!! session('msg') !!}
                        </div>
                    @endif
                        <div class="row">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="thead-dark">
                                        <tr class="text-center">
                                            <th class="" rowspan="2" style="width:10px;">#</th>
                                            <th rowspan="2">Nama Famili</th>
                                            <th rowspan="2">Nama Lokal</th>
                                            <th rowspan="2">Nama Ilmiah</th>
                                            <th rowspan="2">Kategori</th>
                                            <th rowspan="2">Endemik</th>
                                            <th colspan="3">Status Konservasi</th>
                                            <th rowspan="2">Aksi</th>
                                        </tr>
                                        <tr class="text-center">
                                            <th>UU</th>
                                            <th>IUCN</th>
                                            <th>CITES</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($data as $item)
                                            <tr class="text-center">
                                                @php
                                                $json = $item->toJson();
                                                @endphp
                                                <td>{{$item->id}}</td>
                                                <td>{{$item->family->name}}</td>
                                                <td>{{$item->locale_name}}</td>
                                                <td>{{$item->scientific_name}}</td>
                                                <td>{{$item->kategori->name}}</td>
                                                <td>{{$item->endemik}}</td>
                                                <td>{{$item->status_uu_id ? 'Dilindungi' : 'Tidak Dilindungi'}}</td>
                                                <td>{{$item->statusIucn ? $item->statusIucn->name : '-'}}</td>
                                                <td>{{$item->statusCites ? $item->statusCites->name : '-'}}</td>
                                                <td>
                                                        <div class="dropdown show">
                                                            <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="fa fa-wrench"></i>
                                                            </a>
                                                            
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                                <button class="dropdown-item btn-edit" type="button" data-json='{!! $json !!}'><i class="fa fa-pencil"></i> Edit</button>
                                                                <form action="{{route('admin.flora.delete')}}" method="post" onsubmit="return confirm('Anda Yakin ingin menhapus Data ini?');">
                                                                    <input type="hidden" name="id" value="{{$item->id}}">
                                                                    @csrf
                                                                    <button type="submit" class="dropdown-item"><i class="fa fa-trash"></i> 
                                                                        Hapus Data
                                                                    </button>
                                                                </form>
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
                                {{$data->render()}}
                            </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
    var img_template = '<img src="{{asset('assets/images/no_picture.png')}}" class="img img-thumbnail" alt="" data-is-default="true">';
    $(".holders").on('change',function(e){
        var img = $($(e.target).find('img'));
        img.removeClass('img img-thumbnail').addClass('img img-thumbnail');

        if(img.data('is-default') != 'true'){
            $(e.target).next().find('button').first().prop('disabled',false);
        }
    })
    $(document).on('click',".btn-delete",function(e){
        $(e.target).parent().parent().parent().parent().find('.holders').first().html(img_template);
        $(e.target).parent().parent().parent().find('input').first().val('');
        $(e.target).prop('disabled',true);

    });

    $(".btn-edit").click(function(e){
        var data = $(this).data('json');
        console.log(data);
        $("#modal-store-data").modal('toggle');

        for(var key in data){
            $($("#modal-store-data").find('#'+key)).val(data[key]);
        }

        for (let i = 0; i < data.images.length; i++) {
            const element = data.images[i];
            var el = $("#container-image-" + (i));
            if(element == null){
                el.find('.holders').first().html(img_template);
                el.find('button').prop('disabled',true);
            }else{

                var ar = element.split("/");
                var array = [];
                for (let j = 0; j < ar.length; j++) {
                    const part = ar[j];
                    array.push(part);
                    if(j == ar.length - 2){
                        array.push("thumbs");
                    }
                    
                }
                var thumb = array.join("/");
                el.find('.holders').first().html('<img src="'+ (thumb) +'" class="img img-thumbnail" style="height:80px;width:80px" alt="" data-is-default="true">');
                el.find('input').first().val(element);
                el.find('button').prop('disabled',false);
            }
            
            
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
