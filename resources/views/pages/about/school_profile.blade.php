@extends('layouts.main')

@section('title')
	School Profile
@endsection

@section('content')
	<div class="global-header" style="background-image: url('{{ asset('img/intro-banner/1.jpg') }}');">
		<div class="global-header__block">
			<div class="va-block">
				<div class="va-middle text-center">
					<h1>School Profile</h1>
				</div>
			</div>
		</div>
	</div>
    <main id="main">
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<p>SJAI hones morally upright and academic competent students.</p>

					<p>“A Johannine everyday, a leader tomorrow.”</p>
				</div>
				<div class="col-md-4">					
						@include('pages.about.partials.sidebar')					
				</div>
			</div>
			
		</div>
		
    </main>
@endsection