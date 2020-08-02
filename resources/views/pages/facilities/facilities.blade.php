@extends('layouts.main')

@section('title')
	Facilities
@endsection

@section('content')
	<div class="global-header" style="background-image: url('{{ asset('img/intro-banner/1.jpg') }}');">
		<div class="global-header__block">
			<div class="va-block">
				<div class="va-middle text-center">
					<h1>Facilities</h1>
				</div>
			</div>
		</div>
	</div>
    <main id="main">
		<div class="container">
			<div class="row pb-4" style="overflow: hidden">
						<div class="col-md-12" >
							<h4>Theater Room</h4>
							<img src="{{ asset('img/website/theater_room.jpg') }}" alt="" class="img-fluid">
						</div>	
						<div class="col-md-12 mt-5">
							<h4>Speech laboratory</h4>
							<div class="row">
								<div class="col-md-4">
									<img src="{{ asset('img/website/speech_1.jpg') }}" alt="" class="img-fluid">
								</div>
								<div class="col-md-4">
									<img src="{{ asset('img/website/speech_2.jpg') }}" alt="" class="img-fluid">
								</div>
								<div class="col-md-4">
									<img src="{{ asset('img/website/speech_3.jpg') }}" alt="" class="img-fluid">
								</div>
							</div>
						</div>
						<div class="col-md-12 mt-5">
							<h4>Computer Laboratories</h4>
							<div class="row">
								<div class="col-md-4">
									<img src="{{ asset('img/website/comp1.jpg') }}" alt="" class="img-fluid">
								</div>
								{{-- <div class="col-md-4">
									<img src="{{ asset('img/website/comp2.jpg') }}" alt="" class="img-fluid">
								</div> --}}
								<div class="col-md-4">
									<img src="{{ asset('img/website/comp3.jpg') }}" alt="" class="img-fluid">
								</div>
								<div class="col-md-4">
									<img src="{{ asset('img/website/comp4.jpg') }}" alt="" class="img-fluid">
								</div>
							</div>
						</div>	
						<div class="col-md-12 mt-5">
							<h4>RFID</h4>
							<div class="row">
								<div class="col-md-6">
									<img src="{{ asset('img/website/rfid1.jpg') }}" alt="" class="img-fluid">
								</div>
								{{-- <div class="col-md-4">
									<img src="{{ asset('img/website/rfid2.png') }}" alt="" class="img-fluid">
								</div> --}}
								<div class="col-md-6">
									<img src="{{ asset('img/website/rfid3.jpg') }}" alt="" class="img-fluid">
								</div>
							</div>
						</div>		
						<div class="col-md-12 mt-5">
							<h4>Library</h4>
							<div class="row">
								<div class="col-md-4">
									<img src="{{ asset('img/website/library1.jpg') }}" alt="" class="img-fluid">
								</div>
								<div class="col-md-4">
									<img src="{{ asset('img/website/library2.jpg') }}" alt="" class="img-fluid">
								</div>
								<div class="col-md-4">
									<img src="{{ asset('img/website/library3.jpg') }}" alt="" class="img-fluid">
								</div>
							</div>
						</div>	
						<div class="col-md-12 mt-5">
							<h4>Canteen</h4>
							<div class="row">
								<div class="col-md-6">
									<img src="{{ asset('img/website/canteen1.jpg') }}" alt="" class="img-fluid">
								</div>
								<div class="col-md-6">
									<img src="{{ asset('img/website/canteen2.jpg') }}" alt="" class="img-fluid">
								</div>
							</div>
						</div>
			</div>
		</div>
    </main>
@endsection