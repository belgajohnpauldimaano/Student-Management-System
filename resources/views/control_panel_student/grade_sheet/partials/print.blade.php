@extends('control_panel_student.layouts.print_layout')

@section ('content_title')
    Gradesheet
@endsection

@section ('content')
        @if($ClassDetail->section_grade_level == 7)
            <p class="grade7"></p>
        @elseif($ClassDetail->section_grade_level == 8)
            <p class="grade8"></p>
        @elseif($ClassDetail->section_grade_level == 9)
            <p class="grade9"></p>
        @elseif($ClassDetail->section_grade_level == 10)
            <p class="grade10"></p>
        @elseif($ClassDetail->grade_level == 11)

            @if($ClassDetail->strand_id == 1)
                <p class="grade9"></p>
            @elseif($ClassDetail->strand_id == 2)
                <p class="grade7"></p>
                <p class="stem"></p>
            @elseif($ClassDetail->strand_id == 3)
                <p class="grade10"></p>
                <p class="humss"></p>
            @elseif($ClassDetail->strand_id == 4)
                <p class="grade8"></p>
                <p class="abm"></p>
            @endif

        @elseif($ClassDetail->grade_level == 12)
            
            @if($ClassDetail->strand_id == 1)
                <p class="grade9"></p>
            @elseif($ClassDetail->strand_id == 2)
                <p class="grade7"></p>
                <p class="stem"></p>
            @elseif($ClassDetail->strand_id == 3)
                <p class="grade10"></p>
                <p class="humss"></p>
            @elseif($ClassDetail->strand_id == 4)
                <p class="grade8"></p>
                <p class="abm"></p>
            @endif
            
        @endif
        
        @php 
            try {
                if($semester){
                    $Semester = $semester;
                }
            } catch (\Throwable $th) {
                $Semester = \App\Models\Semester::where('current', 1)->first()->id;
            }             
        @endphp
                <p class="heading1">Republic of the Philippines</p>
                <p class="heading1">Department of Education</p>
                <p class="heading1">Region III</p>
                <p class="heading1">Division of Bataan</p>
                <br/>
                <h2 class="heading2 heading2-title">St. John's Academy Inc</h2>
                
                <p class="heading2 heading2-subtitle"><b>Formerly Saint John Academy</b></p>
                <p class="heading2 heading2-subtitle">Dinalupihan, Bataan</p>
                <br/>
                <p class="report-progress m0">
                    REPORT ON LEARNING PROGRESS AND ACHIEVEMENT
                </p>
                <p class="report-progress m0">
                    ( {{ $Enrollment[0] ? $Enrollment[0]->grade_level >= 11 ? 'SENIOR HIGH SCHOOL' : 'JUNIOR HIGH SCHOOL' : '' }} )
                </p>
                <img style="margin-right: 3em; margin-top: {{ $Enrollment[0] ? $Enrollment[0]->grade_level >= 11 ? '4em' : '4.5em' : ''}}"
                 class="logo sja-logo" width="{{ $Enrollment[0] ? $Enrollment[0]->grade_level >= 11 ? 115 : 100 : ''}}"
                 src="{{ $Enrollment[0] ? $Enrollment[0]->grade_level >= 11 ? asset('img/sja-logo.png') : asset('img/sja-logo.png') : ''}}" />
                <img style="margin-left: 3em; margin-top: 4.5em;" class="logo deped-bataan-logo" width="100" 
                src="{{ asset('img/deped-bataan-logo.png') }}" />
                <br/>
                
                <table class="table-student-info">
                    <tr>
                        <td>
                            <p class="p0 m0 student-info"><b>Name</b> : {{ ucfirst($StudentInformation->last_name). ', ' .ucfirst($StudentInformation->first_name). ' ' . ucfirst($StudentInformation->middle_name) }}</p>
                        </td>
                        <td>
                            <p class="p0 m0 student-info"><b>LRN</b> : {{ $StudentInformation->user->username }}</p>
                        </td>
                    </tr>                    
                    <tr>
                        <td>
                            <p class="p0 m0 student-info"><b>School Year</b> : {{ $ClassDetail ? $ClassDetail->schoolYear->school_year : '' }}</p>
                        </td>
                        <td>
                            <p class="p0 m0 student-info"><b>Age</b> : 
                                {{ $StudentInformation->age_may }} years old
                            </p> 
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p class="p0 m0 student-info">
                                <b>Grade & Section </b>: 
                                {{ $ClassDetail ? $ClassDetail->grade_level : '' }}
                                 - 
                                @php
                                    try {
                                         echo $ClassDetail ? $ClassDetail->section->section : '';
                                    } catch (\Throwable $th) {
                                        echo $ClassDetail ? $ClassDetail->section : '';
                                    }
                                @endphp
                                
                            </p>
                        </td>
                        <td>
                            <p class="p0 m0 student-info"><b>Birthdate</b> : {{ $StudentInformation->birthdate ? date_format(date_create($StudentInformation->birthdate), 'F d, Y') : '' }}</p>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>
                            <p class="p0 m0 student-info"><b>K to 12 BASIC EDUCATION CURRICULUM</b></p>
                        </td>
                        <td><p class="p0 m0 student-info"><b>Sex</b> : {{ $StudentInformation->gender == 1 ? "Male" : "Female" }}</p></td>
                    </tr>
                    <tr>
                        @if ($grade_level >= 11)
                            @if($Semester == 1)
                                <td>
                                    <p class="p0 m0 student-info"><b>Track/Strand - Academic:</b> 
                                        @php
                                            try {
                                                $strand_name = \App\Models\Strand::where('id', $ClassDetail->strand_id)
                                                    ->first(); 
                                                echo $strand_name->strand;
                                            } catch (\Throwable $th) {
                                                $strand_name = '';
                                            }  
                                        @endphp                                        
                                    </p>
                                    <p class="p0 m0 student-info"><b>Semester</b> : <i style="color: red">First</i></p>
                                </td>
                                <td>                                        
                                </td>
                            @else
                                <td>
                                    <p class="p0 m0 student-info"><b>Track/Strand - Academic:</b> 
                                        @php  $strand_name = \App\Models\Strand::where('id', $ClassDetail->strand_id)
                                                ->first(); 
                                                echo $strand_name->strand;
                                        @endphp                                        
                                    </p>
                                    <p class="p0 m0 student-info"><b>Semester</b> : <i style="color: red">Second</i></p>
                                </td>
                                <td>                                        
                                </td>
                            @endif
                        @endif
                    </tr>
                </table> 
    <br/>
    
    @if ($grade_level >= 11)
        @if($Semester == 1)
            @include('control_panel_student.grade_sheet.partials.grade_sheet.senior.first_sem')
        @else
            @include('control_panel_student.grade_sheet.partials.grade_sheet.senior.second_sem')            
        @endif
    @else
        @include('control_panel_student.grade_sheet.partials.grade_sheet.junior_grades')
    @endif

@endsection