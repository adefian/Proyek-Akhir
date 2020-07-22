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
					<h4 class="m-4" style="text-align: center; font:">Daftar Poin Tertinggi
                        @if($periode == 'hari')
                            Hari ini
                        @elseif ($periode == 'minggu')
                            Minggu ini
                        @elseif ($periode == 'bulan')
                            Bulan ini
                        @elseif ($periode == 'tahun')
                            Tahun ini
                        @else

                        @endif
					</h4>
					<p class="mt-3">{{ Carbon\Carbon::now()->isoFormat('LLLL')}} WIB</p>
					
                    <table border="1" width="100%">
						<thead>
							<tr align="center" height="20">
								<th>No</th>
								<th>Nama</th>
								<th>No Handphone</th>
								<th>Alamat</th>
								<th>Total Poin</th>
							</tr>
						</thead>

						<tbody>
							@if($data)
							@php $i=1 @endphp

							@foreach($data as $datas)

								<tr align="center">
									<!-- Nomor -->
									<td width="2%">{{$i++}}</td>
									<td width="20%">{{$datas->nama}}</td>
									<td width="17%"> {{$datas->nohp}}</td>							
									<td width="24%">{{$datas->alamat}}</td>							
									<td width="10%">{{$datas->total_poin}}</td>							
								</tr>
							@endforeach
							@endif

						</tbody>
					</table>
				</div>
	 		</div>

	 		<div class="row">
	 			<div class="col-md text-center">
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
			// window.print();
		</script>
	</body>
</html>