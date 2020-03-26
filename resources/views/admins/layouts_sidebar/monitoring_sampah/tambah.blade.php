<div class="modal fade" tabindex="-1" role="dialog" id="modalCreate">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Tambahkan Lokasi</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
         <div class="row">
          <div class="col-lg-6 col-sm-12 col-12">
            <div id="mapInput" style="width: 100%; height: 300px; border-radius: 3px;"></div>
            <button class="btn btn-danger mt-2" id="btn_hapus">Perbarui Lokasi</button>
          </div>
          <div class="col-lg-6 col-sm-12 col-12">
            @if(auth()->user()->role == 'pimpinanecoranger')
                <form class="needs-validation" novalidate="" action="indikasi" method="POST" enctype="multipart/form-data">
            @endif
            @if(auth()->user()->role == 'petugaslapangan')
                <form class="needs-validation" novalidate="" action="indikasi-petugaslap" method="POST" enctype="multipart/form-data">
            @endif
            @if(auth()->user()->role == 'komunitas')
                <form class="needs-validation" novalidate="" action="indikasi-komunitas" method="POST" enctype="multipart/form-data">
            @endif
                {{csrf_field()}}

                <div class="form-group">
                    <label for="namalokasi">Nama Lokasi</label> 
                    <div class="input-group">   
                        <input name="namalokasi" type="text" class="form-control" placeholder="Nama Lokasi" required>      
                    </div>
                </div>
                <div class="form-group">
                    <label for="latitude">Latitude</label> 
                    <div class="input-group">  	
                        <input type="number" step="any" id="lat" name="latitude" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="longitude">Longitude</label> 
                    <div class="input-group">    
                        <input name="longitude" step="any" id="leng" type="number" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">   
                        <input name="status" type="hidden" class="form-control" value="0"> 
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Tambah</button>
                    <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Batal</button>
                </div>
            </form>
          </div>
         </div>
        </div>
    </div>
  </div>
</div>

