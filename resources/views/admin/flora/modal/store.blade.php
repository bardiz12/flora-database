<div class="modal fade" tabindex="-1" role="dialog" id="modal-store-data">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Edit Data</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{route('admin.flora.store')}}" method="POST">
                @csrf
              <input type="hidden" name="id" id="id">
              <div class="modal-body">
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
                        <input type="radio" name="status_uu_id" id="status_uu_id_ya" value="1" autocomplete="off"> Dilindungi
                      </label>
                      <label class="btn btn-primary">
                        <input type="radio" name="status_uu_id" id="status_uu_id_tidak" value="0" autocomplete="off"> Tidak Dilindungi
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
                              <div class="col-4" id="container-image-{{$i}}">
                                  <div class="text-center">
                                          <div id="holder-{{$i}}" class="mt-5 mb-1 holders" style="max-height:100px;">
                                              <img src="{{asset('assets/images/no_picture.png')}}" class="img img-thumbnail" alt="" data-is-default="true">
                                          </div>
                                          <div class="input-group">
                                              <input type="text" name="alt_text[]" class="form-control alt-text-input mb-2" placeholder="Deskripsi Gambar">
                                              
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

              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </form>
          </div>
        </div>
      </div>