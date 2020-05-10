<div class="modal fade" tabindex="-1" role="dialog" id="modalCreate">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Kasih Saran Ecobrick</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">

                <form action="kirimsaranecobrick" method="POST" enctype="multipart/form-data">
            
                {{csrf_field()}}

                <div class="form-group">
                    <label for="namalokasi">Nama Lengkap</label> 
                    <div class="input-group">   
                        <input name="nama_pengirimsaran" type="text" class="form-control" placeholder="Nama Lengkap" required>      
                    </div>
                </div>
                <div class="form-group">
                    <label for="foto_diusulkan">Foto</label> 
                    <div class="input-group">    
                        <input name="foto_diusulkan" type="file" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="keterangan">Keterangan</label> 
                    <div class="input-group">  	
                        <textarea name="keterangan" type="text" class="form-control" required></textarea>
                    </div>
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary float-right ml-2" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary float-right">Kirim</button>
            </div>
            </form>
          </div>
         </div>
  </div>
</div>

