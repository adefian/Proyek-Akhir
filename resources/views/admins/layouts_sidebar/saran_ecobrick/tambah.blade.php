<div class="modal fade" tabindex="-1" role="dialog" id="modalCreate">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Tambah Pengaplikasian Ecobrick</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">

            @if(auth()->user()->role == 'pimpinanecoranger')
                <form class="needs-validation" novalidate="" action="reviewsaranecobrick" method="POST" enctype="multipart/form-data">
            @endif
            @if(auth()->user()->role == 'petugaslapangan')
                <form class="needs-validation" novalidate="" action="reviewsaranecobrick-petugaslap" method="POST" enctype="multipart/form-data">
            @endif
            @if(auth()->user()->role == 'komunitas')
                <form class="needs-validation" novalidate="" action="reviewsaranecobrick-komunitas" method="POST" enctype="multipart/form-data">
            @endif
                {{csrf_field()}}

                <div class="form-group">
                    <label for="foto_diaplikasikan">Foto</label> 
                    <div class="input-group">   
                        <input name="foto_diaplikasikan" type="file" class="form-control" placeholder="file_gambar" required>      
                    </div>
                </div>
                <div class="form-group">
                    <label for="keterangan">Keterangan</label> 
                    <div class="input-group">  	
                        <textarea type="text" name="keterangan" class="form-control" placeholder="Keterangan" style="min-height:43px;" required></textarea>
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