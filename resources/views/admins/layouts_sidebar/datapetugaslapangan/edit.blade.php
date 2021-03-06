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
                <form method="POST" action="/datapetugaslapangan-petugaslap" class="needs-validation" novalidate="" id="editFormpetugaslap" enctype="multipart/form-data">
            @endif
            @if(auth()->user()->role == 'komunitas')
                <form method="POST" action="/datapetugaslapangan-komunitas" class="needs-validation" novalidate="" id="editFormkomunitas" enctype="multipart/form-data">
            @endif
                {{ csrf_field() }}
                {{ method_field('PATCH') }}

                <div class="form-group">
                    <label for="nama">Nama</label> 
                    <div class="input-group">   
                        <input name="nama" type="text" id="nama" class="form-control" placeholder="Nama" required>      
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">Email</label> 
                    <div class="input-group">  	
                        <input name="email" type="email" id="email" class="form-control" placeholder="Email" required>  	
                    </div>
                </div>
                <div class="form-group">
                    <label for="nohp">No Hp</label>
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
                    <div class="d-block">
                        <label for="wilayah" class="control-label">Wilayah</label>
                        <select name="wilayah" type="text" class="form-control">
                            <option selected disabled>Pilih Wilayah</option>
                            <option value="#">Palestine</option>
                            <option value="#">Syria</option>
                            <option value="#">Malaysia</option>
                            <option value="#">Thailand</option>
                        </select>
                    </div>  
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-warning">Edit</button>
                    <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Batal</button>
                </div>
            </form>
      </div>
    </div>
  </div>
</div>
