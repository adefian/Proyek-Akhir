@extends('home.stisla')

@section('content')

        @include('home.include.home')

        @include('home.include.tempat_sampah')
		
        @include('home.include.komunitas')

        @include('home.include.ecobrick')

        @include('home.include.tentang_kami')

		<section class="callout">
			<div class="container">
				<div class="row align-items-center">
					<div class="col-12 col-md-8 text">
						<h3>Start your project with this awesome template</h3>
					</div>
					<div class="col-12 col-md-4 cta">
						<a href="#" class="btn btn-outline-primary">
							Download Now
						</a>
					</div>
				</div>
			</div>
		</section>

@endsection