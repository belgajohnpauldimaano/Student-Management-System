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
							<h3>ACADEMIC SUPPORT</h3>			
							<h4>REGISTRAR</h4>
							<img src="{{ asset('img/website/registrar.jpg') }}" alt="" class="img-fluid">
							<p class="text-justify mt-2">
								Recording of student admission, progress and achievement and preparations of transcripts of records, 
								certificates and diplomas and organization of students’ academic data are done in the Registrar’s Office. 
								The adequacy, accessibility and confidentiality of these data are measures of quality.
							</p>
						</div>	
						<div class="col-md-12">
							<h4>LIBRARY</h4>
							<img src="{{ asset('img/website/library.jpg') }}" alt="" class="img-fluid">
							<p class="text-justify mt-2">
								It is the principal educational-print, non-print and digital materials repository of the school. 
								It is designed to facilitate active and inquiry-based learning, individual study and research and leisurely reading. 
								It serves as an integral part of every learners’ educational experience.
							</p>
						</div>
						<div class="col-md-12">
							<h4>LABORATORIES</h4>
							<img src="{{ asset('img/website/laboratories.jpg') }}" alt="" class="img-fluid">
							<p class="text-justify mt-2">
								It includes the Science Laboratories, Computer Laboratories, Technology and Livelihood Education, and Speech Laboratory.
								They are avenues that promote inquiry, discovery and research, and application of theories and principles covered in the different courses of study.
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