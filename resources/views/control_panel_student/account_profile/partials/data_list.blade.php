<div class="col-sm-12 col-md-6 col-lg-4">
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">Personal Information</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-flat btn-box-tool btn--update-photo" title="Change photo">
                    <i class="fa fa-image"></i>
                </button>
                <form class="hidden" id="form_user_photo_uploader">
                    <input type="file" id="user--photo" name="user_photo">
                    <button type="submit">fsdfasd</button>
                </form>
                <button type="button" class="btn btn-flat btn-box-tool btn--update-profile" title="Update info">
                    <i class="fa fa-wrench"></i>
                </button>
            </div>
        </div>
        <div class="overlay hidden" id="js-loader-overlay"><i class="fa fa-refresh fa-spin"></i></div>
        <div class="box-body">
            <img class="profile-user-img img-responsive img-circle" id="img--user_photo" src="{{ $Profile->photo ? \File::exists(public_path('/img/account/photo/'.$Profile->photo)) ? asset('/img/account/photo/'.$Profile->photo) : asset('/img/account/photo/blank-user.gif') : asset('/img/account/photo/blank-user.gif') }}" alt="User profile picture">
            <h3 class="profile-username text-center" id="display__full_name">{{ $Profile->first_name . ' ' . $Profile->middle_name . ' ' .  $Profile->last_name }}</h3>
            <p class="text-muted text-center">Student</p>
            {{--  <div class="form-group">
                <label for="">Department</label>
                <div class="form-control">{{ collect(\App\FacultyInformation::DEPARTMENTS)->firstWhere('id', $Profile->department_id)['department_name'] }}</div>
            </div>  --}}
            
            <div class="form-group">
                <label for="">ESC</label>
                <div class="form-control" id="display__esc">
                    @if($Profile->isEsc == 1)
                        Yes
                    @elseif($Profile->isEsc == 2)
                        No
                    @else
                        Not Confirmed
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label for="">Birthday</label>
                <div class="form-control" id="display__birthday">{{ date('d F Y', strtotime($Profile->birthdate)) }}</div>
            </div>
            {{--  <div class="form-group">
                <label for="">Age</label>
                <div class="form-control" id="display__age">{{ $Profile->birthday }}</div>
            </div>  --}}
            <div class="form-group">
                <label for="">Gender</label>
                <div class="form-control" id="display__gender">{{ $Profile->gender == 1 ? 'Male' : 'Female' }}</div>
            </div>
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
            <div class="form-group">
                <label for="">Permanent Address</label>
                <div class="form-control" id="display__permanent_address">{{ $Profile->p_address }}</div>
            </div>
            <div class="form-group">
                <label for="">Father's name</label>
                <div class="form-control" id="display__father_name">{{ $Profile->father_name }}</div>
            </div>
            <div class="form-group">
                <label for="">Mother's name</label>
                <div class="form-control" id="display__mother_name">{{ $Profile->mother_name }}</div>
            </div>
        </div>
    </div>
</div>

<div class="col-sm-12 col-md-6 col-lg-4">
    <div class="box box-danger">
        <div class="box-header">
            <h3 class="box-title">User Account</h3>
            <div class="box-tools pull-right">
                {{-- <button type="button" class="btn btn-flat btn-box-tool btn-change-password" title="change password">
                    <i class="fa fa-wrench"></i>
                </button> --}}
            </div>
        </div>
        

        <div class="overlay hidden" id="js-loader-overlay"><i class="fa fa-refresh fa-spin"></i></div>
        <div class="box-body">
            <div class="form-group">
                <label for="">Username</label>
                <div class="form-control">{{ $User->username }}</div>
            </div>
            <div class="form-group">
                <label for="">Password</label>
                <div class="form-control">******</div>
            </div>
        </div>
    </div>
</div>