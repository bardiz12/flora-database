@extends('layouts.app')

@section('content')
<style>

</style>

@include('admin.family.modal.store')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Import CSV File</div>

                <div class="card-body">
                        @if (session('msg'))
                        <div class="alert alert-{{session('msg-status')}}" role="alert">
                            {{ session('msg') }}
                        </div>
                    @endif
                        <form action="{{route('admin.import.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                              <div class="modal-body">    
                              <p>Format Data : <a href="{{asset('storage/sistem/flora-format.csv')}}" target="_blank">Download</a><br/>
                                <strong>NB: HANYA GUNAKAN FORMAT DATA DIATAS. dan pastikan pengaturan delimeter CSV anda adalah ";"</strong>
                            </p>            
                                  <div class="form-group">
                                    
                                    <label>File .csv</label>
                                    <input type="file" class="form-control-file" name="file" accept=".csv" required>
                                  </div>                                   
                              </div>
                              <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Save</button>
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
