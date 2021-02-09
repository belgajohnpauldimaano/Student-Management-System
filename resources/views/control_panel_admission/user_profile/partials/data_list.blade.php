<div class="col-sm-12 col-md-6">
    <div class="card card-danger">
        <div class="card-header">
            <h3 class="card-title">Personal Information</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool btn--update-photo" title="Change photo">
                    <i class="fa fa-image"></i>
                </button>
                <form class="d-none" id="form_user_photo_uploader">
                    <input type="file" id="user--photo" name="user_photo">
                    <button type="submit">save</button>
                </form>
                <button type="button" class="btn btn-tool btn--update-profile" title="Update info">
                    <i class="fa fa-wrench"></i>
                </button>
            </div>
            {{-- <div class="box-tools pull-right">
                <button type="button" class="btn  btn-box-tool btn--update-photo" title="Change photo">
                    <i class="fa fa-image"></i>
                </button>
                
                <button type="button" class="btn  btn-box-tool btn--update-profile" title="Update info">
                    <i class="fa fa-wrench"></i>
                </button>
            </div> --}}
            <div class="mt-5 text-center">
                <img class="profile-user-img img-responsive img-circle" 
                    id="img--user_photo" src="{{ $Profile->photo ? \File::exists(public_path('/img/account/photo/'.$Profile->photo)) 
                    ? asset('/img/account/photo/'.$Profile->photo) 
                    : asset('/img/account/photo/blank-user.gif') 
                    : asset('/img/account/photo/blank-user.gif') }}" 
                    alt="User profile picture"
                >
                <h3 class="profile-username text-center" id="display__full_name">
                    {{ $Profile->first_name . ' ' . $Profile->middle_name . ' ' .  $Profile->last_name }}
                </h3>
                <p class="text-muted text-center text-white-50">Student</p>
            </div>
        </div>
        <div class="card-body">
            {{-- <div class="form-group">
                <label for="">Gender</label>
                <div class="form-control" id="display__gender">{{ $Profile->gender == 1 ? 'Male' : 'Female' }}</div>
            </div> --}}
            <div class="form-group">
                <label for="">E-mail</label>
                <div class="form-control" id="display__email">{{ $Profile->email }}</div>
            </div>
            <div class="form-group">
                <label for="">Contact Number</label>
                <div class="form-control" id="display__contact_number">{{ $Profile->contact_number }}</div>
            </div>
            <div class="form-group">
                <label for="">Current Address</label>
                <div class="form-control" id="display__current_address">{{ $Profile->c_address }}</div>
            </div>
        </div>
    </div>
</div>

<div class="col-sm-12 col-md-8">
    <div class="card card-danger">
        <div class="card-header">
            <h3 class="card-title">Payroll</h3>
        </div> 
        <div class="overlay d-none" id="js-loader-overlay-trainings_seminars">
            <i class="fas fa-2x fa-sync-alt fa-spin"></i>
        </div>
        <div class="overlay d-none" id="js-loader-overlay-trainings_seminars"><i class="fa fa-refresh fa-spin"></i></div>
        <div class="card-body">
            <table class="table table-sm table-bordered table-condensed">
                <tr>
                    <th style="width: 30%">Payroll Date</th>
                    <th>Files</th>
                    <th>Action</th>
                </tr>
                <tbody>
                    @forelse ($payroll as $item)
                        <tr>
                            <td>{{  $item ? date_format(date_create($item->payroll_date), 'F d, Y') : ''  }}</td>
                            <td>
                                @foreach ($item->documents as $data)
                                    <a href="">
                                        {{ decrypt($data->path_name) }}
                                    </a>
                                @endforeach
                            </td>
                            <td>
                                @foreach ($item->documents as $data)
                                    <a href="{{ asset('data/payroll/'.decrypt($data->path_name)) }}" class="btn btn-primary btn-sm">
                                        Download
                                    </a>
                                 @endforeach
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <th class="text-center" colspan="3"> No Data Available</th>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="col-sm-12 col-md-4">
    <div class="card card-danger">
        <div class="card-header">
            <h3 class="card-title">User Account</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool btn-change-password" title="change password">
                    <i class="fa fa-wrench"></i>
                </button>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="overlay d-none" id="js-loader-overlay">
            <i class="fas fa-2x fa-sync-alt fa-spin"></i>
        </div>
        <div class="card-body" style="display: block;">
            <div class="form-group">
                <label for="">Username</label>
                <div class="form-control">{{ $User->username }}</div>
            </div>
            <div class="form-group">
                <label for="">Password</label>
                <div class="form-control">******</div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
</div>