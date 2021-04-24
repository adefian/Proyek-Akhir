<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>- Pick Me Up -</title>

        <link href="{{asset('assets-landingpage/img/logo-L.png')}}" rel="icon">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

		<style type="text/css">

			table tr td, table tr th {
				font-size: 10pt;
			}

			@media print {
				@page {size: A4 landscape; }
			}

		</style>
	</head>

	<body> 
		<div class="container-fluid">	
			<div class="row justify-content-center">
				<div class="col-10">
					<h4 class="m-4" style="text-align: center; font:">Daftar Agenda
						@if($jenis_agenda)
							@if($jenis_agenda == 'mendesak')
							Mendesak
							@else
							Tidak Mendesak
							@endif
						@endif
                        @if($kom)
                            {{$namakomunitas->daerah}}
                        @endif
                        @if($periode == 'hari')
                            Hari ini
                        @elseif ($periode == 'minggu')
                            Minggu ini
                        @elseif ($periode == 'bulan')
                            Bulan ini
                        @elseif ($periode == 'tahun')
                            Tahun ini
                        @endif
						@if($tahun)
							{{$tahun}}
						@endif
                    </h4>
					<p class="mt-3">{{ Carbon\Carbon::now()->isoFormat('LLLL')}} WIB</p>
                    <table border="1" class="col-12" width="100%">
						<thead>
							<tr align="center" height="25">
								<th>No</th>
								<th>Nama Kegiatan</th>
								<th>Komunitas</th>
								<th>Keterangan</th>
								<th>Jenis Kegiatan</th>
								<th>Tanggal</th>
								<th>Yang</br>Menambahkan</th>
							</tr>
						</thead>
						<tbody>
                        @if(auth()->user()->role == 'pimpinanecoranger')
							@if($data)
							@php $i=1 @endphp
							@foreach($data as $datas)

								<tr align="center">
									<!-- Nomor -->
									<td width="3%">{{$i++}}</td>
									<td width="13%">{{$datas->nama}}</td>
									<td width="13%">{{$datas->komunitas->daerah}}</td>							
									<td width="30%">{{$datas->keterangan}}</td>							
									<td width="14%">
										@if($datas->jenis_agenda == 1)
                                            <span style="width:80%; align:center;" class="badge badge-danger">Agenda Mendesak</span>
                                            @elseif($datas->jenis_agenda == 2)
                                            <span style="width:80%; align:center;" class="badge badge-warning">Agenda Penting</span>
                                            @else
                                            <span style="width:80%; align:center;" class="badge badge-success">Agenda Rutin</span>
                                        @endif
									</td>		
									<td width="12%">{{ Carbon\Carbon::parse($datas->tanggal)->isoFormat('LLLL') }} WIB</td>
									<td width="10%">{{$datas->petugasygmenambahkan->username}}</td>    					
								</tr>
							@endforeach
							@endif
						@elseif(auth()->user()->role == 'pimpinankomunitas' || auth()->user()->role == 'komunitas')
							@if($komunitas)
							@php $i=1 @endphp
							@foreach($komunitas as $datas)

								<tr align="center">
									<!-- Nomor -->
									<td width="3%">{{$i++}}</td>
									<td width="13%">{{$datas->nama}}</td>
									<td width="13%">{{$datas->komunitas->daerah}}</td>							
									<td width="30%">{{$datas->keterangan}}</td>							
									<td width="12%">
										@if($datas->jenis_agenda == 1)
                                            <span style="width:80%; align:center;" class="badge badge-warning">Agenda Mendesak</span>
                                            @else
                                            <span style="width:80%; align:center;" class="badge badge-success">Agenda tidak Mendesak</span>
                                        @endif
									</td>		
									<td width="12%">{{ Carbon\Carbon::parse($datas->tanggal)->isoFormat('LLLL') }} WIB</td>
									<td width="10%">{{$datas->petugasygmenambahkan->username}}</td>    					
								</tr>
							@endforeach
							@endif
						@endif
						</tbody>
					</table>
				</div>
			</div>

			<div class="row">
				<div class="col-12 float-right text-right">
						<!-- QrCode -->
						<input id="text" type="hidden" value="{{$pimpinan->nama}}, {{auth()->user()->email}}"></input>
						<div id="qrcode" class="float-right" style="width:100px; height:100px; margin-top:40px; margin-right:170px"></div>
				</div>
			</div>
		</div>
	<script type="text/javascript" src="{{asset('assets/Qr_Code/jquery.min.js')}}"></script>
		<script type="text/javascript" src="{{asset('assets/Qr_Code/qrcode.js')}}"></script>
	<script type="text/javascript">
		var qrcode = new QRCode(document.getElementById("qrcode"), {
			width : 80,
			height : 80
		});

		function makeCode () {		
			var elText = document.getElementById("text");
			
			qrcode.makeCode(elText.value);
		}

		makeCode();

		$("#text").
			on("blur", function () {
				makeCode();
			}).
			on("keydown", function (e) {
				if (e.keyCode == 13) {
					makeCode();
				}
			});
		</script>
		<script type="text/javascript">
			window.print();

			window.onafterprint = function(){
				alert("Prose Printing Selesai...");
            }
		</script>
	</body>
</html>