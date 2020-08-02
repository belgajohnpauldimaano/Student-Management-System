
<div class="list-group list-group-sidebar">
	<h4>SERVICES</h4>
	<a class="list-group-item text-muted {{ Request::is('students-services-academic') ? 'selected' : '' }}" href="{{ route('students_services_academic') }}">ACADEMIC SUPPORT</a>
	<a class="list-group-item text-muted {{ Request::is('students-services-development') ? 'selected' : '' }}" href="{{ route('students_services_development') }}">STUDENT DEVELOPMENT SERVICES</a>
</div>