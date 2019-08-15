<div class="modal fade" tabindex="-1" role="dialog" id="modal-store-data">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Edit Data</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{route('admin.kategori.store')}}" method="POST">
                @csrf
              <input type="hidden" name="id" id="id">
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