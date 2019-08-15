@extends('layouts.app')

@section('content')
<style>

</style>
@include('plugins.lfm-image')
@include('admin.family.modal.store')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Data Famili</div>

                <div class="card-body">
                        <form action="{{route('admin.flora.store')}}" method="POST">
                                @csrf
                              
                                  <div class="form-group">
                                    <label>Family</label>
                                    <select class="form-control" name="family_id" required id="family_id" >
                                        @foreach ($families as $fam)
                                            <option value="{{$fam->id}}">{{$fam->name}}</option>
                                        @endforeach
                                    </select>
                                    
                                  </div>
                                  <div class="form-group">
                                  <label>Nama Lokal</label>
                                    <input type="text" name="locale_name" id="locale_name" required class="form-control">
                                  </div>
                                  
                                  <div class="form-group">
                                  <label>Nama Ilmiah</label>
                                    <input type="text" name="scientific_name" id="scientific_name" required class="form-control">
                                  </div>
                
                                  <div class="form-group">
                                  <label>Kategori</label>
                                  <select class="form-control" name="kategori_id" required id="kategori_id" >
                                      @foreach ($kategori as $fam)
                                          <option value="{{$fam->id}}">{{$fam->name}}</option>
                                      @endforeach
                                  </select>
                                  </div>
                
                                <div class="form-group">
                                  <label>Endemik</label>
                                    <input type="text" name="endemik" id="endemik" required class="form-control">
                                  </div>
                                  <h4>Status Konservasi</h4>
                                    <div class="form-group">
                                        <label class="d-block">Undang - Undang</label>
                                        <div class="btn-group" data-toggle="buttons">
                                            <label class="btn btn-primary">
                                                <input type="radio" name="status_uu_id" id="status_uu_id_ya" value="1" autocomplete="off" required> Dilindungi
                                            </label>
                                            <label class="btn btn-primary">
                                                <input type="radio" name="status_uu_id" id="status_uu_id_tidak" value="0" autocomplete="off" required> Tidak Dilindungi
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>IUCN</label>
                                        <select class="form-control" name="status_iucn_id" required id="status_iucn_id" >
                                            @foreach ($status_iucn as $fam)
                                                <option value="{{$fam->id}}">{{$fam->name}} - {{$fam->description}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                    
                                    <div class="form-group">
                                        <label>Cites</label>
                                        <select class="form-control" name="status_cites_id" required id="status_cites_id" >
                                            @foreach ($status_cites as $fam)
                                                <option value="{{$fam->id}}">{{$fam->name}} - {{$fam->description}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <h4>Gambar</h4>
                                        <div class="row">
                                            @for ($i = 0; $i < 5; $i++)
                                                <div class="col-4">
                                                    <div class="text-center">
                                                            <div id="holder-{{$i}}" class="mt-5 mb-1 holders" style="max-height:100px;">
                                                                <img src="{{asset('assets/images/no_picture.png')}}" class="img img-thumbnail" alt="" data-is-default="true">
                                                            </div>
                                                            <div class="input-group d-block">
                                                                <span class="input-group-btn text-center">
                                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                                            <a data-input="thumbnail-{{$i}}" data-preview="holder-{{$i}}" class="btn btn-primary lfm">
                                                                                    <i class="fa fa-picture-o"></i> Choose
                                                                                </a>
                                                                            <button type="button" class="btn btn-danger btn-delete" disabled><i class="fa fa-trash"></i></button>

                                                                            </div>
                                                                    
                                                                </span>
                                                                <input id="thumbnail-{{$i}}" type="hidden" name="images[]">
                                                            </div>
                                                    </div>
                                                </div>
                                            @endfor
                                        </div>
                                              
                                    </div>

                                    <div class="form-group">
                                        <div class="pull-right">
                                            <button type="submit" class="btn btn-primary">Tambahkan</button>
                                        </div>
                                    </div>
                                </div>

                                

                            </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
    $(".holders").on('change',function(e){
        var img = $($(e.target).find('img'));
        img.removeClass('img img-thumbnail').addClass('img img-thumbnail');

        if(img.data('is-default') != 'true'){
            $(e.target).next().find('button').first().prop('disabled',false);
        }
    })
    $(".btn-delete").on('click',function(e){
        $(e.target).parent().parent().parent().parent().find('.holders').first().html('<img src="{{asset('assets/images/no_picture.png')}}" class="img img-thumbnail" alt="" data-is-default="true">');
        $(e.target).parent().parent().parent().find('input').first().val('');
        $(e.target).prop('disabled',true);

    });
});
</script>
@endsection
