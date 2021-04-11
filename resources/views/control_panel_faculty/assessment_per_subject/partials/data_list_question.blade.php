<div class="float-right" style="margin-top: -.5em">
    @if($Assessment != null)
        <a href="{{ route('faculty.question', [encrypt($Assessment->id), 'tab' => 'questions'] ) }}" class="btn btn-sm btn-sm btn-info">
            <i class="far fa-eye fa-lg"></i> Preview
        </a>
    @endif
</div>

<h5>Create Items</h5>
<hr>
<div class="form-group form-group-sm w-100 pb-5">
    <label>Select Exam Type:</label>
    <select class="form-control form-control-sm" name="question_type" style="width: 100%;">
        <option value="1" {{ $question == null ? '' : $question =='1' ? 'selected' : ''  }}>Multiple Choice</option>
        <option value="2" {{ $question == null ? '' : $question =='2' ? 'selected' : ''  }}>True/False</option>
        <option value="3" {{ $question == null ? '' : $question =='3' ? 'selected' : ''  }}>Matching</option>
        <option value="4" {{ $question == null ? '' : $question =='4' ? 'selected' : ''  }}>Ordering</option>
        <option value="5" {{ $question == null ? '' : $question =='5' ? 'selected' : ''  }}>Fill in the Blank Text or Identification</option>
        <option value="6" {{ $question == null ? '' : $question =='6' ? 'selected' : ''  }}>Short Answer/Essay</option>
        {{-- <option value="7" {{ $question == null ? '' : $question =='7' ? 'selected' : ''  }}>Enumeration</option> --}}
    </select>
    <div class="help-block text-red" id="js-question_type"></div>
    <div class="mt-1 float-right">
        <button type="button" id="btn-question-type-selected" class="btn btn-sm btn-primary">
            <i class="far fa-hand-pointer fa-lg"></i> Select
        </button>
    </div>
</div>

<div id="multiple-choice mt-3" >
    <form id="js-question-form">
        {{ csrf_field() }}
        @if($Assessment != null)
            <input type="hidden" name="id" value="{{ $Assessment->id }}">
        @endif

        @if($question=='1' || $question=='2' || $question=='3' || $question=='4' || $question=='5' || $question=='6')
            <div class="card">
                <div id="js-head-type">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="ion ion-clipboard mr-1"></i>
                            <b>Exam Type: 
                            @if($question=='1')
                                Multiple Choice
                            @endif
                            @if($question=='2')
                                True/False
                            @endif
                            @if($question=='3')
                                Matching
                            @endif
                            @if($question=='4')
                                Ordering
                            @endif
                            @if($question=='5')
                                Fill in the Blank Text or Identification
                            @endif
                            @if($question=='5')
                                Short Answer/Essay
                            @endif
                            </b>
                        </h3>
                        <div class="card-tools"></div>
                    </div>
                </div>

                <!-- /.card-header -->
                <div>
                    <div class="card-body">
                        <input type="hidden" id="js_question_type" name="js_question_type" value="{{ $question }}">
                        @if($question=='1' || $question=='2' || $question=='3' || $question=='4' || $question=='6')
                        <div class="form-group" id="question_setup">
                            <label for="summernote">Question Setup</label>
                            <textarea name="question" class="js-question_setup"></textarea>
                            <div class="help-block text-red" id="js-question"></div>
                        </div>
                        @endif
                        {{-- multiple-choice --}}
                        @if($question=='1')
                            @include('control_panel_faculty.assessment_per_subject.question_type.multiple')
                        @endif

                         {{-- true or false --}}
                        @if($question=='2')
                            @include('control_panel_faculty.assessment_per_subject.question_type.truefalse')
                        @endif

                        {{-- matching type --}}
                        @if($question=='3')
                            @include('control_panel_faculty.assessment_per_subject.question_type.matching')
                        @endif

                        {{-- ordering --}}
                        @if($question=='4')
                            @include('control_panel_faculty.assessment_per_subject.question_type.ordering')
                        @endif

                        {{-- fill in the blanks or identification --}}
                        @if($question=='5')
                            @include('control_panel_faculty.assessment_per_subject.question_type.identification')
                        @endif

                        {{-- essay --}}
                        @if($question=='6')
                            @include('control_panel_faculty.assessment_per_subject.question_type.essay')
                        @endif

                       
                    </div>
                    <div class="card-footer clearfix">
                        <button type="submit" class="btn btn-sm btn-primary float-right">
                            <i class="fas fa-save"></i> Save
                        </button>
                    </div>
                </div>
            </div>
        @endif
    </form>
</div>