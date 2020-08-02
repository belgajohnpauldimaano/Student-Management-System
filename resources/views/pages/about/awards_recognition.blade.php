@extends('layouts.main')

@section('title')
	Awards Recognition
@endsection

@section('content')
	<div class="global-header" style="background-image: url('{{ asset('img/intro-banner/1.jpg') }}');">
		<div class="global-header__block">
			<div class="va-block">
				<div class="va-middle text-center">
					<h1>Awards Recognition</h1>
				</div>
			</div>
		</div>
	</div>
    <main id="main">
		<div class="container">
			<div class="row">
				<div class="col-md-8" align="justify">
					<div class="row mt-2">
						<div class="col-md-3">
							<img src="{{ asset('img/website/award1.png') }}" alt="" class="img-fluid">
						</div>
						<div class="col-md-9 mt-2">
							Saint John’s Academy Inc. upholds quality education through assessment and research for more than two decades
						</div>						
					</div>
					<div class="row mt-3">
						<div class="col-md-3">
							<img src="{{ asset('img/website/award2.jpg') }}" alt="" class="img-fluid">
						</div>
						<div class="col-md-9">
							Empowering our students with tools that will allow them to be creators, and our research, and our teachers with the capacity to innovate how they teach each Genyo e-Learning 

						</div>						
					</div>
					<div class="row mt-3 mb-3">
						<div class="col-md-3">
							<img src="{{ asset('img/website/award3.jpg') }}" alt="" class="img-fluid">
						</div>
						<div class="col-md-9">
							SJAI has shown EXCELLENCE in using technology through Genyo e-Learning. COMMITMENT to 21st century initiates to improve their teaching and learning environment, and the WILLINGNESS TO SHARE their experiences and learnings to fellow educators who have chosen to pursue a path towards innovation
						</div>
						<div class="col-md-3">
							{{-- <img src="{{ asset('img/website/award3.jpg') }}" alt="" class="img-fluid"> --}}
						</div>
						<div class="col-md-9 mt-3" align="center">
							<img src="{{ asset('img/website/award4.jpg') }}" alt="" class="img-fluid">
						</div>
					</div>
				</div>
				
				<div class="col-md-4">
					@include('pages.about.partials.sidebar')
				</div>
				
			</div>
			
		</div>
    </main>
@endsection