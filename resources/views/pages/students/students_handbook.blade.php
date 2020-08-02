@extends('layouts.main')

@section('title')
	Students Handbook
@endsection

@section('content')
	<div class="global-header" style="background-image: url('{{ asset('img/intro-banner/1.jpg') }}');">
		<div class="global-header__block">
			<div class="va-block">
				<div class="va-middle text-center">
					<h1>Students Handbook</h1>
				</div>
			</div>
		</div>
	</div>
    <main id="main">
		<div class="container">
			<p>
				The <b>STUDENT HANDBOOK</b> contains information of parents and students, alike.
				  Study it very carefully so that your stay at <b>ST. JOHN’S ACADEMY INC.</b>  
				be both pleasant and productive. These policies, rules and regulations were formulated not to create restrictions and regulate conduct; more importantly, 
				they should serve to guide us all smoothly along the road to learning and maturity as Christians and as Filipinos.
				  This STUDENT HANDBOOK will guide us all towards a better education.
			</p>
		</div>
    </main>
@endsection