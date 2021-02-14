@extends('control_panel.layouts.master')

@section ('content_title')
    Home
@endsection

@section ('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card card-default">
                {{-- <div class="overlay hidden" id="js-loader-overlay"><i class="fa fa-refresh fa-spin"></i></div> --}}
                <div class="card-header">
                    <h3 class="card-title">ACTIVITY:</h3>
                </div>
                <div class="overlay d-none" id="js-overlay-create">
                    <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="js-data-container">
                            @include('control_panel_faculty.home.partials.data_list')
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
          {{-- reminders --}}
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Reminders</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  {{-- <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button> --}}
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="js-data-container2">
                    @include('control_panel_faculty.home.partials.data_reminder_list')
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer text-center">
                <a href="javascript:void(0)" class="uppercase">View All Assignments</a>
              </div>
              <!-- /.card-footer -->
            </div>
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Recently Added Lessons</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  {{-- <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button> --}}
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="js-data-container3">
                    @include('control_panel_faculty.home.partials.data_lesson_list')
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer text-center">
                <a href="javascript:void(0)" class="uppercase">View All Lessons</a>
              </div>
              <!-- /.card-footer -->
            </div>.
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('cms-new/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('cms/plugins/datetimepicker/datetimepicker.js') }}"></script>
    <script>
        $(function () {
            // Summernote
            $('.select2').select2();
            $('#publishdatetime, #expdatetime').datetimepicker({
                autoclose: true,
                format: 'yyyy-mm-dd hh:ii'
            })
            // $('#summernote').summernote()
            $('#summernote').summernote({
                  toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['para', ['ul']],
                    ['insert', ['table','link', 'picture', 'video']],
                    ['view', ['fullscreen', 'help']
                  ],
                  // ['codeview']
                  ],
                  height: 100,
                  codemirror: {
                  theme: 'monokai'
                  },
                  placeholder: 'write here...',
                  spellCheck: true
              });


            $('body').on('click', '.js-modal', function (e) {
                e.preventDefault();
                // if($('#js-overlay-create').hasClass('overlay')){
                //   $('#js-overlay-create').addClass('d-none')
                // }
                let dataSections = "";
                let type = $(this).data('type');
                fetchCreateAssessment();

                if ($('#js-editor').hasClass('d-none')) {
                    $('#js-editor').removeClass('d-none')
                    $('.js-create-editor').addClass('d-none')
                    $('#js-title_type').text(type)
                } else {
                    $('#js-editor').addClass('d-none')
                    $('.js-create-editor').removeClass('d-none')
                }
            });

            $('body').on('click', '.js-close-editor', function (e) {
                e.preventDefault();

                let type = $(this).data('type');

                if ($('#js-editor').hasClass('d-none')) {
                    $('#js-editor').removeClass('d-none')
                    $('.js-create-editor').addClass('d-none')
                } else {
                    $('#js-editor').addClass('d-none')
                    $('.js-create-editor').removeClass('d-none')
                }
            });

            function fetchCreateAssessment(dataSections){
              $.ajax({
                  url : "{{ route('faculty.assessment.create') }}",
                  type : 'get',
                  data : {_token : '{{ csrf_token() }}'},
                  success     : function (res) {
                      
                      // loader_overlay('js-overlay-create');
                      
                      let dataSections = "";
                      $.each(res.section, function(i){
                          dataSections += '<option val="'+res.section.id+'">' + res.section[i].section+'-'+ res.section[i].grade_level + ' '+ res.section[i].subject +'</option>';
                      })
                      $('#js-section_subjects').html(dataSections);
                      $('#js-category_type').val('assessment');
                  }
              });
            }

            

        })
    </script>
@endsection