@extends('layouts_admin.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Tukar Code</div>

                <div class="card-body">
                    <form action="" method="post">
                    <div class="form-group">
                    <label for="kode" class="control-label">Kode</label>
                      <input id="kode" type="kode" class="form-control" name="kode" tabindex="1" required autofocus>
                    </div>
                    <div class="btn btn-info" type="submit">Tukar</div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection