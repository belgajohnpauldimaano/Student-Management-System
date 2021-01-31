<div class="row">
        <div class="col-md-4">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">User Profile</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool btn--update-photo" title="Chane photo">
                                <i class="fa fa-image"></i>
                            </button>
                            <form class="d-none" id="form_user_photo_uploader">
                                <input type="file" id="user--photo" name="user_photo">
                                <button type="submit">fsdfasd</button>
                            </form>
                            <button type="button" class="btn  btn-tool btn--update-profile" title="Update info">
                                <i class="fa fa-wrench"></i>
                            </button>
                        </div>
                    </div>
                    <div class="overlay d-none" id="js-loader-overlay">
                        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <img class="profile-user-img img-responsive img-circle" id="img--user_photo" src="{{ $Profile->photo ? \File::exists(public_path('/img/account/photo/'.$Profile->photo)) ? asset('/img/account/photo/'.$Profile->photo) : asset('/img/account/photo/blank-user.gif') : asset('/img/account/photo/blank-user.gif') }}" alt="User profile picture">
                            <h3 class="profile-username text-center" id="display__full_name">{{ $Profile->first_name . ' ' . $Profile->middle_name . ' ' .  $Profile->last_name }}</h3>
                            <p class="text-muted text-center">Faculty Member</p>
                        </div>
                        <div class="form-group">
                            <label for="">Department</label>
                            <div class="form-control">{{ collect(\App\Models\FacultyInformation::DEPARTMENTS)->firstWhere('id', $Profile->department_id)['department_name'] }}</div>
                        </div>
                        <div class="form-group">
                            <label for="">Contact Number</label>
                            <div class="form-control" id="display__contact_number">{{ $Profile->contact_number }}</div>
                        </div>
                        <div class="form-group">
                            <label for="">E-mail</label>
                            <div class="form-control" id="display__email">{{ $Profile->email }}</div>
                        </div>
                        <div class="form-group">
                            <label for="">Address</label>
                            <div class="form-control" id="display__address">{{ $Profile->address }}</div>
                        </div>
                        <div class="form-group">
                            <label for="">Birthday</label>
                            <div class="form-control" id="display__birthday">{{ $Profile->birthday }}</div>
                        </div>
                    </div>
                </div>

                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">User Account</h3>
                        <div class="card-tools pull-right">
                            <button type="button" class="btn  btn-tool btn-change-password" title="change password">
                                <i class="fa fa-wrench"></i>
                            </button>
                        </div>
                    </div>
                    

                    <div class="overlay d-none" id="js-loader-overlay">
                        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                    </div>

                    <div class="card-body">
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
        </div>
        <div class="col-md-8">
                <div class="col-md-12">
                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">Educational Attainment</h3>
                            <div class="card-tools pull-right">
                                <button type="button" class="btn  btn-tool btn-add-educ" title="Add eductational attainment">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div> 

                        <div class="overlay d-none" id="js-loader-overlay-education">
                            <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                        </div>

                        <div class="card-body">
                            <table class="table table-sm table-bordered table-condensed text-center">
                                <tr>
                                    <th>Course</th>
                                    <th>School</th>
                                    <th>Years</th>
                                    <th>Awards</th>
                                    <th>Actions</th>
                                </tr>
                                <tbody id="education_attainment_container">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">Trainings and Seminars</h3>
                            <div class="card-tools pull-right">
                                <button type="button" class="btn  btn-tool btn-trainings_seminars" title="Add eductational attainment">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div> 
                        <div class="overlay d-none" id="js-loader-overlay-trainings_seminars">
                            <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                        </div>
                        <div class="overlay d-none" id="js-loader-overlay-trainings_seminars"><i class="fa fa-refresh fa-spin"></i></div>
                        <div class="card-body">
                            <table class="table table-sm table-bordered table-condensed text-center">
                                <tr>
                                    <th>Title</th>
                                    <th>Date</th>
                                    <th>Venue</th>
                                    <th>Sponsor</th>
                                    <th>Facilitator</th>
                                    <th>Type</th>
                                    <th>Actions</th>
                                </tr>
                                <tbody id="trainings_seminars_container">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
    </div>