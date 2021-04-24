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
                <div class="row">
                    <div class="col-lg-6 col-sm-12 col-12">
                        <div id="mapInput2" style="width: 100%; height: 300px; border-radius: 3px;"></div>
                        <p>klik satu kali untuk menentukan posisi</p>
                    </div>
                    <div class="col-lg-6 col-sm-12 col-12">
                        @if(auth()->user()->role == 'pimpinanecoranger')
                            <form id="editForm" class="needs-validation" novalidate="" action="" method="POST" enctype="multipart/form-data">
                        @endif
                        @if(auth()->user()->role == 'petugaslapangan')
                            <form id="editFormpetugaslap" class="needs-validation" novalidate="" action="" method="POST" enctype="multipart/form-data">
                        @endif
                        @if(auth()->user()->role == 'komunitas')
                            <form id="editFormkomunitas" class="needs-validation" novalidate="" action="" method="POST" enctype="multipart/form-data">
                        @endif
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}

                            <div class="form-group">
                                <label for="nama">Nama Lokasi</label> 
                                <div class="input-group">   
                                    <input name="nama" id="nama" type="text" class="form-control" placeholder="Nama Lokasi" required>      
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="latitude">Latitude</label> 
                                <div class="input-group">  	    
                                    <input type="number" step="any" id="lat2" name="latitude" class="latude form-control" value="" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="longitude">Longitude</label> 
                                <div class="input-group">    
                                    <input name="longitude" step="any" id="leng2" type="number" class="longit form-control" value="" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="file_gambar">Foto</label> 
                                <div class="input-group">    
                                    <input name="file_gambar" type="file" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">   
                                    <input name="status" id="status" type="hidden" class="form-control" value="kosong"> 
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Edit</button>
                                <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

