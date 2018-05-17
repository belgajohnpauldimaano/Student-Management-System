@extends('layouts.main')

@section('title')
	Vision and Mission
@endsection

@section('content')
	<div class="global-header" style="background-image: url('{{ asset('img/intro-banner/1.jpg') }}');">
		<div class="global-header__block">
			<div class="va-block">
				<div class="va-middle text-center">
					<h1>Vision and Mission</h1>
				</div>
			</div>
		</div>
	</div>
    <main id="main">
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<h2>Vision</h2>
					<p>We envision to develop morally, socially upright, and competitive Filipino citizens equipped with total quality  education and Christian formation in the service of a humane and peaceful society.</p>

					<h2>Vision</h2>
					<p>Commitment to develop morally, socially upright and globally competitive Filipino citizens.</p>
					
					<h2>Goals</h2>	
					<ol>
						<li>To provide the total Christian formation to the youth by giving them various faith avenues that will develop them to become authentic Catholic / Christians.</li>
						<li>To provide a curriculum and instructional facilities that will develop their skills to become globally competitive Filipino citizens.</li>
						<li>To develop a roster of excellent administrative and faculty members who will continually engage in their holistic development.</li>
						<li>To foster an environment of social, economic and political awareness responsive to the changing needs of the society.</li>
					</ol>			
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