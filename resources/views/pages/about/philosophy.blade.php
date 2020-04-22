@extends('layouts.main')

@section('title')
	Philosophy
@endsection

@section('content')
	<div class="global-header" style="background-image: url('{{ asset('img/intro-banner/1.jpg') }}');">
		<div class="global-header__block">
			<div class="va-block">
				<div class="va-middle text-center">
					<h1>The PHILOSOPHY of ST. JOHN’S ACADEMY INC.</h1>
				</div>
			</div>
		</div>
	</div>
    <main id="main">
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<h2>The PHILOSOPHY of ST. JOHN’S ACADEMY INC.</h2>
					<p>St. John’s Academy Inc. believes that every leaner’s unique gifts and blended intelligences comes from God; 
						engages comes in its discovery, development and nurturance towards full humanity.</p>		
					<br>
					<br>
				</div>
				<div class="col-md-4">
                    @include('pages.about.partials.sidebar')
				</div>
			</div>
		</div>
    </main>
@endsection