@extends('layouts.app')

@section('content')
<style>

</style>

@include('admin.family.modal.store')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Data Famili</div>

                <div class="card-body">
                    <form action="{{route('admin.family.store')}}" method="POST">
                        @csrf
                        
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name" required id="name"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="text-right mr-4">
                                        <button type="submit" class="btn btn-primary">Save</button>
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
