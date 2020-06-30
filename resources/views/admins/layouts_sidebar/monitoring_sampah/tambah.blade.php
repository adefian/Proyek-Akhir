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
            <div id="mapInput" style="width: 100%; height: 320px; border-radius: 3px;"></div>
            <p>klik satu kali untuk menentukan posisi</p>
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
                    <label for="nama">Nama Lokasi</label> 
                    <div class="input-group">   
                        <input name="nama" type="text" class="form-control" placeholder="Nama Lokasi" required>      
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
                    <label for="foto">Foto</label> 
                    <div class="input-group">    
                        <input name="foto" type="file" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">   
                        <input name="status" type="hidden" class="form-control" value="kosong"> 
                    </div>
                </div>
                    <button type="button" class="btn btn-secondary float-right ml-2" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success float-right">Tambah</button>
            </form>
          </div>
         </div>
        </div>
    </div>
  </div>
</div>

