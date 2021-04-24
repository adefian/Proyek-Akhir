<div class="modal fade" tabindex="-1" role="dialog" id="modalCreate">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Tambahkan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
        <div class="modal-body">
            @if(auth()->user()->role == 'pimpinanecoranger')
                <form class="needs-validation" novalidate="" action="{{route('datapetugaslapangan.store')}}" method="POST" enctype="multipart/form-data">
            @endif
            @if(auth()->user()->role == 'petugaslapangan')
                <form class="needs-validation" novalidate="" action="{{route('datapetugaslapangan-petugaslap.store')}}" method="POST" enctype="multipart/form-data">
            @endif
            @if(auth()->user()->role == 'komunitas')
                <form class="needs-validation" novalidate="" action="{{route('datapetugaslapangan-komunitas.store')}}" method="POST" enctype="multipart/form-data">
            @endif
                {{csrf_field()}}

                <div class="form-group">
                    <label for="nama">Nama</label> 
                    <div class="input-group">   
                        <input name="nama" type="text" class="form-control" placeholder="Nama" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">Email</label> 
                    <div class="input-group">  	
                        <input name="email" type="email" class="form-control" placeholder="Email" required autofocused>  	
                    </div>
                </div>
                <div class="form-group">
                    <label for="nohp">No Hp</label>
                    <div class="input-group">  
                        <input name="nohp" type="number" class="form-control" placeholder="No Handphone/WA" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <div class="input-group">    
                        <input name="alamat" type="text" class="form-control" placeholder="Alamat" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="d-block">
                        <label for="wilayah" class="control-label">Wilayah</label>
                        <select name="wilayah" type="text" class="form-control">
                            <option selected disabled>Pilih Wilayah</option>
                            @if($komunitas)
                            @foreach($komunitas as $datas)
                                <option value="{{$datas->daerah}}">{{$datas->daerah}}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Tambahkan</button>
                    <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Batal</button>
                </div>
            </form>
      </div>
    </div>
  </div>
</div>

