@extends('layouts.main')

@section('title')
	Students Organization
@endsection

@section('content')
	<div class="global-header" style="background-image: url('{{ asset('img/intro-banner/1.jpg') }}');">
		<div class="global-header__block">
			<div class="va-block">
				<div class="va-middle text-center">
					<h1>Students Organization</h1>
				</div>
			</div>
		</div>
	</div>
    <main id="main">
		<div class="container">
			<div class="row mb-5">
				<div class="col-md-4 mt-3">
					<img src="{{ asset('img/website/so1.jpg') }}" alt="" class="img-fluid">
				</div>
				<div class="col-md-4 mt-3">
					<img src="{{ asset('img/website/so2.jpg') }}" alt="" class="img-fluid">
				</div>
				<div class="col-md-4 mt-3">
					<img src="{{ asset('img/website/so3.jpg') }}" alt="" class="img-fluid">
				</div>
				<div class="col-md-4 mt-3">
					<img src="{{ asset('img/website/so4.jpg') }}" alt="" class="img-fluid">
				</div>
				<div class="col-md-4 mt-3">
					<img src="{{ asset('img/website/so5.jpg') }}" alt="" class="img-fluid">
				</div>
				<div class="col-md-4 mt-3">
					<img src="{{ asset('img/website/so6.jpg') }}" alt="" class="img-fluid">
				</div>
				<div class="col-md-4 mt-3">
					<img src="{{ asset('img/website/so7.jpg') }}" alt="" class="img-fluid">
				</div>
				<div class="col-md-4 mt-3">
					<img src="{{ asset('img/website/so8.png') }}" alt="" class="img-fluid">
				</div>
				<div class="col-md-4 mt-3">
					<img src="{{ asset('img/website/so9.png') }}" alt="" class="img-fluid">
				</div>
				<div class="col-md-4 mt-3">
					<img src="{{ asset('img/website/so10.png') }}" alt="" class="img-fluid">
				</div>
				<div class="col-md-4 mt-3">
					<img src="{{ asset('img/website/so11.jpg') }}" alt="" class="img-fluid">
				</div>												
			</div>
		</div>
    </main>
@endsection