<div class="modal fade" tabindex="-1" role="dialog" id="modal-show-data">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Show Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>What data you want to be shown?</p>
        <div class="menu-button">
            <a href="{{route('admin.family.index')}}" class="btn btn-primary btn-block"><h5><i class="fa fa-database"></i> Data Family</h5></a>
            <a href="{{route('admin.flora.index')}}" class="btn btn-dark btn-block"><h5><i class="fa fa-database"></i> Data Flora</h5></a>
            <a href="{{route('admin.kategori.index')}}" class="btn btn-warning btn-block"><h5><i class="fa fa-database"></i> Data Kategori</h5></a>
            <a href="{{route('admin.status.index')}}" class="btn btn-success btn-block"><h5><i class="fa fa-database"></i> Data Status Konservasi</h5></a>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>