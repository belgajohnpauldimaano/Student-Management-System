@extends('layouts.main')

@section('title')
	Students Services
@endsection

@section('content')
	<div class="global-header" style="background-image: url('{{ asset('img/intro-banner/1.jpg') }}');">
		<div class="global-header__block">
			<div class="va-block">
				<div class="va-middle text-center">
					<h1>Students Services</h1>
				</div>
			</div>
		</div>
	</div>
    <main id="main">
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<div class="row pl-4 pr-4">	
							
						<div class="col-md-12">
							<h3>STUDENT DEVELOPMENT SERVICES</h3>	
							<p>Assist in the growth and development of the school community.</p>

							<h4>GUIDANCE AND COUNSELING PROGRAM</h4>
							<img src="{{ asset('img/website/guidance.jpg') }}" alt="" class="img-fluid">
							<p class="text-justify mt-2">
								Assists the learners in their personal and interpersonal relations through the admission services, guidance orientation, individual inventory, testing and research, counseling, career guidance development and placement and follow-up services.
							</p>
						</div>	
						<div class="col-md-12">
							<h4>STUDENT DISCIPLINE PROGRAM</h4>
							<img src="{{ asset('img/website/descipline.jpg') }}" alt="" class="img-fluid">
							<p class="text-justify mt-2">
								Covers matters on student decorum, behavior formation and disciplinary measures when called for. It is implemented by a Student Welfare Coordinator.
							</p>
						</div>
						<div class="col-md-12">
							<h4>MEDICAL/ DENTAL SERVICES</h4>
							<div class="row">
								<div class="col-md-4">
									<img src="{{ asset('img/website/med1.jpg') }}" alt="" class="img-fluid">
									<img src="{{ asset('img/website/med3.jpg') }}" alt="" class="img-fluid mt-4">
								</div>
								<div class="col-md-4"><img src="{{ asset('img/website/med2.jpg') }}" alt="" class="img-fluid"></div>
								
							</div>
							<p class="text-justify mt-2">
								Provide for primary medical and dental procedures and proper nutrition essential for the well-being of the learners while they are in school.
							</p>
						</div>	
						<div class="col-md-12">
							<h4>FINANCE</h4>
							<img src="{{ asset('img/website/finance.jpg') }}" alt="" class="img-fluid">
							<p class="text-justify mt-2">
								Assist students and parents to ensure day to day collection and regulates online payment.  
							</p>
						</div>												
					</div>
				</div>
				
					<div class="col-md-4">
						@include('pages.students.partials.sidebar')
					</div>
				
			</div>
		</div>		
    </main>
@endsection