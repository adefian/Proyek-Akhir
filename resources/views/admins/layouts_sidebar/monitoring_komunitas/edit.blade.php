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
                <form method="POST" action="/kelolaagenda" class="needs-validation" novalidate="" id="editForm" enctype="multipart/form-data">
            @endif
            @if(auth()->user()->role == 'pimpinankomunitas')
                <form method="POST" action="/kelolaagenda-pimpinankom" class="needs-validation" novalidate="" id="editFormpimpinankom" method="POST" enctype="multipart/form-data">
            @endif
            @if(auth()->user()->role == 'komunitas')
                <form method="POST" action="/kelolaagenda-komunitas" class="needs-validation" novalidate="" id="editFormkomunitas" method="POST" enctype="multipart/form-data">
            @endif
                {{ csrf_field() }}
                {{ method_field('PATCH') }}

                <div class="form-group">
                    <label for="nama">Nama Agenda</label> 
                    <div class="input-group">   
                        <input name="nama" id="nama" type="text" class="form-control" placeholder="Nama Agenda" required>      
                    </div>
                </div>
                <div class="form-group">
                    <label for="keterangan">Keterangan</label> 
                    <div class="input-group">  	
                        <textarea type="text" name="keterangan" id="keterangan" class="form-control" placeholder="Keterangan" style="min-height:43px;" required></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="tanggal">Tanggal</label>
                    <div class="input-group">    
                        <input name="tanggal" placeholder="Pilih Tanggal" id="tanggal" type="datetime-local" class="form-control" min="{{Carbon\Carbon::now()->format('Y-m-d\TH:i')}}"  required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="jenis_agenda">Jenis Agenda saat ini <p id="jenis_agenda"></p>
                    </label>
                    <div class="input-group">    
                        <select name="jenis_agenda" type="text" class="form-control">
                            <option selected disabled>Pilih Jenis Agenda</option>
                            <option value="1">Mendesak</option>
                            <option value="0">Tidak Mendesak</option>
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
