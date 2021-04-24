<div class="modal fade" tabindex="-1" role="dialog" id="modalCreate">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Tambahkan Komunitas</h5>
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
                    <form class="needs-validation" novalidate="" action="{{route('daftarkomunitas.store')}}" method="POST" enctype="multipart/form-data">
                @endif
                @if(auth()->user()->role == 'petugaslapangan')
                    <form class="needs-validation" novalidate="" action="{{route('daftarkomunitas-petugaslap.store')}}" method="POST" enctype="multipart/form-data">
                @endif
                @if(auth()->user()->role == 'komunitas')
                    <form class="needs-validation" novalidate="" action="{{route('daftarkomunitas-komunitas.store')}}" method="POST" enctype="multipart/form-data">
                @endif
                    {{csrf_field()}}

                    <div class="form-group">
                        <label for="daerah">Daerah</label> 
                        <div class="input-group">   
                            <input name="daerah" type="text" class="form-control" placeholder="Daerah" required>      
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label> 
                        <div class="input-group">   
                            <textarea name="keterangan" type="text" class="form-control" placeholder="Keterangan" required></textarea>
                        </div>
                        <small class="text-danger">Kenapa anda ingin mendaftarkan daerah ini.</small>
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
                        <button type="button" class="btn btn-secondary float-right ml-2" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success float-right">Tambah</button>
                </form>
            </div>
          </div>
        </div>
    </div>
  </div>
</div>