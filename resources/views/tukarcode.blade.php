<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  
  @yield('css')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" >
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" >
 

  <!-- CSS Libraries -->

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{asset('assets/stisla/css/style.css')}}">
  <link rel="stylesheet" href="{{asset('assets/stisla/css/custom.css')}}">
  <link rel="stylesheet" href="{{asset('assets/stisla/css/components.css')}}">
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <link rel="shortcut icon" href="{{asset('assets-landingpage/img/logo-L.png')}}">
</head>
<body>
    
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Tukar Code</div>

                <div class="card-body">

                    <form action="{{route('pushtukarcode', [1])}}" method="POST">
                    
                {{ csrf_field() }}
                {{ method_field('POST') }}
                    <div class="form-group">
                    <label for="kode_reward" class="control-label">Kode</label>
                      <input id="kode_reward" type="text" class="form-control" name="kode_reward" tabindex="1" required autofocus>
                    </div>
                    <button class="btn btn-info" type="submit">Tukar</button>
                    </form>
                </div>
            </div>
        </div>
        <h1>Nama : {{$masyarakat->nama}}</h1>
        <h1>Total Poin : {{$masyarakat->total_poin}}</h1>
    </div>
    
</div>

</body>
</html>