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
					<h2>Strategic Thrust</h2>
					<ol>
						<li>Academic Excellence</li>
						<li>Character Development</li>
						<li>Organization and System Excellence</li>
					</ol>

					<h2>Vision</h2>
					<p>By 2025, St. John's Academy Inc. is the leading innovative Catholic School in Dinalupihan, Bataan</p>
					
					<h2>Mission</h2>
					<p>Devoted to norture innovative and globally competitive students and servant-leaders for building humane communities.</p>
					<ol>
						<li>To provide innovative curriculum and instruction that will develop learners' skills to become globally competitive.</li>
						<li>To foster an inclusive environment conducive to character development and Christian formation that will produce model graduates catered to transform society</li>
						<li>To provide communal activities that will enable the school personnel, faculty and students to become individual who can lead, relate and respond to the changing needs of the society</li>
						<li>To develop a roster of excellent administrative and faculty members who will continually engae in their holistic development.</li>
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