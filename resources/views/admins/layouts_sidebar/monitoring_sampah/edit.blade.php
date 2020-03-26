<div class="modal fade" tabindex="-1" role="dialog" id="editModal">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Edit Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
        <div class="modal-body">
            @if(auth()->user()->role == 'pimpinanecoranger')
                <form method="POST" action="/datapetugaslapangan" class="needs-validation" novalidate="" id="editForm" enctype="multipart/form-data">
            @endif
            @if(auth()->user()->role == 'petugaslapangan')
                <form method="POST" action="/datapetugaslapangan-petugaslap" class="needs-validation" novalidate="" id="editFormpetugaslap" method="POST" enctype="multipart/form-data">
            @endif
            @if(auth()->user()->role == 'komunitas')
                <form method="POST" action="/datapetugaslapangan-komunitas" class="needs-validation" novalidate="" id="editFormkomunitas" method="POST" enctype="multipart/form-data">
            @endif
                {{ csrf_field() }}
                {{ method_field('PATCH') }}

                <div class="form-group">
                    <label for="namalokasi">Nama Lokasi</label> 
                    <div class="input-group">   
                        <input name="namalokasi" type="text" id="namalokasi" class="form-control" placeholder="Nama" required>      
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">Latitude</label> 
                    <div class="input-group">  	
                        <input name="email" type="email" id="email" class="form-control" placeholder="Email" required>  	
                    </div>
                </div>
                <div class="form-group">
                    <label for="nohp">Longitude</label>
                    <div class="input-group">    
                        <input name="nohp" type="text" id="nohp" class="form-control" placeholder="No Hp">
                    </div>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <div class="input-group">    
                        <input name="alamat" type="text" id="alamat" class="form-control" placeholder="Alamat">
                    </div>
                </div>
                <div class="form-group">
                    <label for="wilayah">Wilayah</label>
                    <div class="input-group">    
                        <input name="wilayah" type="text" id="wilayah" class="form-control" placeholder="Wilayah">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-warning">Edit</button>
                    <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Cancel</button>
                </div>
            </form>
      </div>
    </div>
  </div>
</div>
