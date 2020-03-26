<div class="modal fade" tabindex="-1" role="dialog" id="modalCreate">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
        <div class="modal-body">
            <form action="/tambahanalisiskimia" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}

                <div class="form-group">
                    <label for="id">Nomor</label> 
                    <div class="input-group">   
                        <input name="id" type="text" class="form-control" placeholder="Nomor">      
                    </div>
                </div>
                <div class="form-group">
                    <label for="jenis_uji">Nama Kegiatan<a class="text-danger">*</a></label> 
                    <div class="input-group">  	
                        <input name="jenis_uji" type="text" class="form-control" placeholder="Jenis Uji" required>  	
                    </div>
                </div>
                <div class="form-group">
                    <label for="tarif">Tanggal<a class="text-danger">*</a></label>
                    <div class="input-group">    
                        <input name="tarif" id="dater" type="text" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="metode">Keterangan</label>
                    <div class="input-group">  	
                        <input name="metode" type="text" class="form-control" placeholder="Metode">
                    </div>
                </div>
                <div class="form-group">
                    <label for="tarif">Jenis Agenda<a class="text-danger">*</a></label>
                    <div class="input-group">    
                        <input name="tarif" type="text" class="form-control" placeholder="ex : 800000">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Tambah</button>
                </div>
            </form>
      </div>
    </div>
  </div>
</div>

