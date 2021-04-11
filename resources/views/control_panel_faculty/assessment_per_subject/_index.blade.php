@extends('control_panel.layouts.master')

@section ('content_title')
  {{ $Assessment != null ? 'Edit' : 'Create' }} Assessment | {{ $ClassSubjectDetail->classDetail->grade->id . '-' .$ClassSubjectDetail->classDetail->section->section }}
@endsection

@section ('content')
    <div class="card">
        <div class="overlay d-none" id="js-loader-overlay">
            <i class="fas fa-2x fa-sync-alt fa-spin"></i>
        </div>
        <div class="col-md-12">
            <a href="{{ route('faculty.assessment_subject', [encrypt($ClassSubjectDetail->id), 'tab' => $Assessment->assessment_status ] ) }}" style="margin-top: -3em" class="btn-success btn btn-sm float-right">
                <i class="fas fa-arrow-left"></i> back
            </a>
        </div>
        <div class="card-header p-2">
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link {{ $tab ? $tab == 'setup' ? 'active' : '' : '' }}" href="{{ route('faculty.assessment_subject.edit', [encrypt($Assessment->id), 'tab' => 'setup']) }}" >
                        Settings
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $tab ? $tab == 'instruction' ? 'active' : '' : '' }}" href="{{ route('faculty.assessment_subject.edit', [encrypt($Assessment->id), 'tab' => 'instruction']) }}">
                        Instruction
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $tab ? $tab == 'questions' ? 'active' : '' : '' }}" href="{{ route('faculty.assessment_subject.edit', [encrypt($Assessment->id), 'tab' => 'questions']) }}">
                        Question
                    </a>
                </li>
                <li class="nav-item">
                    <a id="tab-monitoring" class="nav-link {{ $tab ? $tab == 'monitoring' ? 'active' : '' : '' }}" href="{{ route('faculty.assessment_subject.edit', [encrypt($Assessment->id), 'tab' => 'monitoring']) }}">
                        Monitoring
                    </a>
                </li>
                <li class="nav-item ml-auto dropdown">
                    <a class="nav-link bg-danger dropdown-toggle" data-toggle="dropdown" href="#">
                      <i class="fas fa-cog"></i> Action <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="#" class="dropdown-item js-btn-publish" data-id="{{ $Assessment->id }}" data-type="{{ $Assessment->exam_status == 1 ? 'unpublish' : 'publish' }}">
                            <i class="far fa-check-square"></i> Move to {{ $Assessment->exam_status == 1 ? 'Unpublish' : 'Publish' }}
                        </a>
                        @if($tab == 'archived')
                            <a href="#" class="dropdown-item js-btn-publish" data-id="{{ $Assessment->id }}" data-type="{{ $Assessment->exam_status == 1 ? 'unpublish' : 'publish' }}">
                                <i class="far fa-check-square"></i> Move to Unpublish
                            </a>
                        @else
                            <a href="#" class="dropdown-item js-btn_archived" data-id="{{ $Assessment->id }}">
                                <i class="fas fa-archive"></i> Move as Archive
                            </a>
                        @endif
                    </div>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <input type="hidden" id="tab" value="{{ $tab }}">
            <input type="hidden" id="assessment_id" value="{{ encrypt($Assessment->id) }}">
            <input type="hidden" id="class_subject_detail_id" value="{{ encrypt($ClassSubjectDetail->id) }}">

            <div class="tab-content">
                <div class="tab-setup {{ $tab ? $tab == 'setup' ? 'active' : '' : '' }} tab-pane" id="setup">
                    @include('control_panel_faculty.assessment_per_subject.partials.data_list_setup')
                </div>                
                <div class="{{ $tab ? $tab == 'instruction' ? 'active' : '' : '' }} tab-pane" id="instruction">
                    @include('control_panel_faculty.assessment_per_subject.partials.data_list_instruction')
                </div>
                <div class="{{ $tab ? $tab == 'questions' ? 'active' : '' : '' }} tab-pane" id="questions">
                    @include('control_panel_faculty.assessment_per_subject.partials.data_list_question')                    
                </div>                
                <div class="{{ $tab ? $tab == 'monitoring' ? 'active' : '' : '' }} tab-pane" id="monitoring">
                    @include('control_panel_faculty.assessment_per_subject.partials.data_list_monitoring')
                </div>
            </div>
            <!-- /.tab-content -->
        </div><!-- /.card-body -->
    </div>
@endsection

@section ('scripts')
    <script src="{{ asset('cms-new/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('cms/plugins/datetimepicker/datetimepicker.js') }}"></script>
    <script src="{{ asset('cms-new/dist/js/pages/dashboard.js') }}"></script>
    <script src="{{ asset('js/assessment.js') }}"></script>
@endsection