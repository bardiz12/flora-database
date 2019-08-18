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
                              <div class="alert alert-primary">
                                    <p>Format Data : <a href="{{asset('storage/sistem/flora-format.csv')}}" target="_blank">Download</a><br/>
                                        <strong>NB: HANYA GUNAKAN FORMAT DATA DIATAS. dan pastikan pengaturan delimeter CSV anda adalah ";"</strong>
                                    </p>            
                              </div>
                                  <div class="form-group">
                                    
                                    <label>File .csv</label>
                                    <input type="file" class="form-control-file" name="file" accept=".csv" required>
                                  </div>   
                                  <div class="form-group">
                                      <label><i class="fa fa-gear"></i> Settings</label>
                                      <div class="ml-2">
                                          <label>Jika ada data yang duplikat : </label>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="customRadio1" name="duplicate" class="custom-control-input" value="skip" required>
                                                <label class="custom-control-label" for="customRadio1">Skip Data</label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="customRadio2" name="duplicate" class="custom-control-input" value="update" required>
                                                <label class="custom-control-label" for="customRadio2">Update Data</label>
                                            </div>
                                      </div>
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
