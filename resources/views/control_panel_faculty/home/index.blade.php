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
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <ul class="products-list product-list-in-card pl-2 pr-2">
                  <li class="item">
                    <div class="product-img">
                      <img src="https://adminlte.io/themes/v3/dist/img/default-150x150.png" alt="Product Image" class="img-size-50">
                    </div>
                    <div class="product-info">
                      <a href="javascript:void(0)" class="product-title">FILIPINO</a>
                      <span class="product-description">
                        Pang-uri
                      </span>
                    </div>
                  </li>                  
                </ul>
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
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <ul class="products-list product-list-in-card pl-2 pr-2">
                  <li class="item">
                    <div class="product-img">
                      <img src="https://adminlte.io/themes/v3/dist/img/default-150x150.png" alt="Product Image" class="img-size-50">
                    </div>
                    <div class="product-info">
                      <a href="javascript:void(0)" class="product-title">FILIPINO</a>
                      <span class="product-description">
                        Pang-uri
                      </span>
                    </div>
                  </li>                  
                </ul>
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
    <script>
        $(function () {
            // Summernote
            $('.select2').select2();
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

                var type = $(this).data('type');
                $.ajax({
                    url : "{{ route('finance.home.modal_data') }}",
                    type : 'POST',
                    data : { _token : '{{ csrf_token() }}', type : type },
                    success : function (res) {
                        $('.js-modal_holder').html(res);
                        $('.js-modal_holder .modal').modal({ backdrop : 'static' });

                        $('.select2').select2();
                        $('#summernote').summernote();

                    }
                });
            });

        })
    </script>
@endsection