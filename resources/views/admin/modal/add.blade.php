<div class="modal fade" tabindex="-1" role="dialog" id="modal-add-data">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Add Data</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>What kind of data want to add?</p>
              <div class="menu-button">
                  <a href="{{route('admin.family.create')}}" class="btn btn-primary btn-block"><h5><i class="fa fa-plus"></i> add Family Data</h5></a>
                  <a href="{{route('admin.flora.create')}}" class="btn btn-dark btn-block"><h5><i class="fa fa-plus"></i> add Flora Data</h5></a>
                  <a href="{{route('admin.kategori.create')}}" class="btn btn-warning btn-block"><h5><i class="fa fa-plus"></i> add Kategori Data</h5></a>
                  <a href="{{route('admin.status.create')}}" class="btn btn-success btn-block"><h5><i class="fa fa-plus"></i> add Status Konservasi Data</h5></a>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>