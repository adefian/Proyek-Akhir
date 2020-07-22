<div class="modal fade" tabindex="-1" role="dialog" id="modalCreate">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Tambahkan Agenda</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">

            @if(auth()->user()->role == 'pimpinanecoranger')
                <form class="needs-validation" novalidate="" action="{{route('kelolaagenda.store')}}" method="POST" enctype="multipart/form-data">
            @endif
            @if(auth()->user()->role == 'petugaslapangan')
                <form class="needs-validation" novalidate="" action="{{route('kelolaagenda-petugaslap.store')}}" method="POST" enctype="multipart/form-data">
            @endif
            @if(auth()->user()->role == 'komunitas')
                <form class="needs-validation" novalidate="" action="{{route('kelolaagenda-komunitas.store')}}" method="POST" enctype="multipart/form-data">
            @endif
            @if(auth()->user()->role == 'pimpinankomunitas')
                <form class="needs-validation" novalidate="" action="{{route('kelolaagenda-pimpinankom.store')}}" method="POST" enctype="multipart/form-data">
            @endif
                {{csrf_field()}}

                <div class="form-group">
                    <label for="nama">Nama Agenda</label> 
                    <div class="input-group">   
                        <input name="nama" type="text" class="form-control" placeholder="Nama Agenda" required>      
                    </div>
                </div>
                <div class="form-group">
                    <label for="keterangan">Keterangan</label> 
                    <div class="input-group">  	
                        <textarea type="text" name="keterangan" class="form-control" placeholder="Keterangan" style="min-height:43px;" required></textarea>
                    </div>
                    <small class="text-danger">Kenapa anda ingin mengadakan agenda ini.</small>
                </div>
                <div class="form-group">
                    <label for="jenis_agenda">Jenis Agenda</label>
                    <div class="input-group">    
                      <select name="jenis_agenda" id="jenisagenda" type="text" class="form-control">
                        <option selected disabled>Pilih Jenis Agenda</option>
                        <option value="1">Mendesak</option>
                        <option value="2">Penting</option>
                        <option value="3">Rutin</option>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="tanggal">Tanggal</label>
                    <div class="input-group">    
                        <input name="tanggal" id="tanggal-max" placeholder="Pilih Tanggal" type="datetime-local" class="form-control" min="{{Carbon\Carbon::now()->format('Y-m-d\TH:i')}}" required>
                    </div>
                        <small id="pemberitahuan"></small>
                </div>              
                <div class="form-group">
                    <label for="file_gambar">Gambar</label>
                    <div class="input-group">    
                        <input name="file_gambar" type="file" class="form-control">
                    </div>
                </div>

                @if(auth()->user()->role === 'pimpinanecoranger')
                <div class="form-group">
                    <label for="komunitas_id">Dari Komunitas</label>
                    <div class="input-group">    
                      <select name="komunitas_id" type="text" class="form-control">
                        <option selected disabled>Pilih</option>
                            @foreach($daerah as $datas)
                                <option value="{{$datas->id}}">{{$datas->daerah}}</option>
                            @endforeach
                      </select>
                    </div>
                </div>
                @endif
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Tambah</button>
                    <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
  </div>
</div>