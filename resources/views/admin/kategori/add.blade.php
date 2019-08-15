@extends('layouts.app')

@section('content')
<style>

</style>

@include('admin.family.modal.store')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Add Status Konservasi</div>

                <div class="card-body">
                        <form action="{{route('admin.kategori.store')}}" method="POST">
                                @csrf
                              <div class="modal-body">
                                  <div class="form-group">
                                    <label>Judul Status</label>
                                    <input type="text" class="form-control" name="name" required id="name"/>
                                  </div>
                
                                  <div class="form-group">
                                    <label>Description</label>
                                    <input type="text" class="form-control" name="description" id="description" required/>
                                  </div>                                   
                              </div>
                              <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              </div>
                            </form>
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
        $("#modal-store-data").modal('show');
        $($("#modal-store-data").find('#id')).val(data.id);
        $($("#modal-store-data").find('#name')).val(data.name);
    })
});
</script>
@endsection
