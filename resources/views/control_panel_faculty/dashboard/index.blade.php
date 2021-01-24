@extends('control_panel.layouts.master')

@section ('content_title')
    Dashboard
@endsection

@section ('content')
    <div class="row">
        <div class="col-sm-12 col-md-3">
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>{{ $StudentInformation_tagged_student->total_students }}</h3>
                    <p>Total Tagged Students</p>
                </div>
                <div class="icon">
                    <i class="ion ion-ios-people-outline"></i>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-3">
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>{{ $StudentInformation_tagged_student_male->total_students }}</h3>
                    <p>Tagged Male</p>
                </div>
                <div class="icon">
                    <i class="fas fa-male"></i>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-3">
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>{{ $StudentInformation_tagged_student_female->total_students }}</h3>
                    <p>Tagged Female</p>
                </div>
                <div class="icon">
                    <i class="fas fa-female"></i>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-3">
            <div class="small-box bg-blue">
                <div class="inner">
                    <h3>{{ $ClassSubjectDetail_count->subject_count }}</h3>
                    <p>Current Subject</p>
                </div>
                <div class="icon">
                    <i class="fas fa-book"></i>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card card-default">
                {{-- <div class="overlay hidden" id="js-loader-overlay"><i class="fa fa-refresh fa-spin"></i></div> --}}
                <div class="card-header">
                    <h3 class="card-title">Recent Post:</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <button type="button" class="btn btn-default w-100" data-toggle="modal" data-target="#modal-lg">
                            Write a Post
                        </button>
                        <div class="modal fade show" id="modal-lg" style="padding-right: 17px;" aria-modal="true" role="dialog">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Write a Post/Lesson</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group w-100">
                                            <label>Post Category/Purpose</label>
                                            <select class="form-control select2" style="width: 100%;">
                                                <option>Announcement</option>
                                                <option>Lesson</option>
                                                <option>Assessment</option>
                                            </select>
                                        </div>
                                        <div class="form-group w-100">
                                            <label>Section</label>
                                            <select class="select2" multiple="multiple" data-placeholder="Select a State" style="width: 100%;">
                                                <option>Alabama</option>
                                                <option>Alaska</option>
                                                <option>California</option>
                                                <option>Delaware</option>
                                                <option>Tennessee</option>
                                                <option>Texas</option>
                                                <option>Washington</option>
                                            </select>
                                        </div>
                                        <div class="form-group w-100">
                                            <label>Post Status</label>
                                            <select class="form-control select2" style="width: 100%;">
                                                <option selected="selected">Published</option>
                                                <option>Draft</option>
                                                <option>Archived</option>
                                            </select>
                                        </div>

                                        <div class="form-group w-100">
                                            <label for="">Post Title</label>
                                                <input type="text" class="form-control" name="title" value="">
                                                <div class="help-block text-red text-center" id="title-error">
                                            </div>
                                        </div>
                                        <textarea id="summernote"></textarea>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
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
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('cms-new/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script>
        $(function () {
            // Summernote
            $('#summernote').summernote();
            $('.select2').select2();

        })
    </script>
@endsection