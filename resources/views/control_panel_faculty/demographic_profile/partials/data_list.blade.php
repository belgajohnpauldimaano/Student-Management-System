<div class="js-data-container1">
<table class="table table-sm no-margin table-hover table-bordered">
    <thead>
        <tr>
            <th style="width: 30px">#</th>
            <th style="width: ">Student Name</th>   
            <th style="width: 180px; text-align:center">Birthdate</th>
            <th style="width: 90px; text-align:center">Age June</th>
            <th style="width: 90px; text-align:center">Age May</th>
            <th style="text-align:center" >Address</th>
            {{-- <th>Gender</th> --}}
            <th style="text-align:center" >Guardian</th>
            {{-- <th>Father Name</th> --}}
            {{-- <th>Mother Name</th>    --}}
            <th style="text-align:center" >Action</th>                                 
        </tr>
    </thead>
    <tbody>    
        <tr>
            <td colspan="16">
                <b>Male</b> 
            </td>
        </tr>
        @forelse ($EnrollmentMale as $key => $data) 
            <form class="js_demographic">
                {{ csrf_field() }}
                <tr>
                    <td>{{ $key + 1 }}.</td>
                    <td>{{ $data->student_name }}</td>
                    <td>
                        <input type="hidden" id="stud_id" name="stud_id" value="{{  $data->student_information_id }}" />

                        <div class="input-group date">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="far fa-calendar-alt"></i>
                                </span>
                            </div>
                            <input type="text" name="birthdate" class="datepicker form-control form-control-sm pull-right" id="datepicker" placeholder="DOB" value="{{ $data ? date_format(date_create( $data->birthdate), 'm/d/Y') : '' }}">
                        </div>
                        <div class="help-block text-red text-center" id="js-birthdate">
                        </div>
                    </td>
                    <td>
                        <input type="text" class="form-control form-control-sm" name="age_june" value="{{ $data ? $data->age_june : '' }}" placeholder="Age">
                        <div class="help-block text-red text-center" id="js-age_june">
                        </div>                                                    
                    </td>
                    <td>
                        <input type="text" class="form-control form-control-sm" name="age_may" value="{{ $data ? $data->age_may : '' }}" placeholder="Age">
                        <div class="help-block text-red text-center" id="js-age_may">
                        </div>
                    </td>
                    <td>
                        <input type="text" class="form-control form-control-sm" name="address" value="{{ $data ? $data->c_address : '' }}" placeholder="Address">
                        <div class="help-block text-red text-center" id="js-address">
                        </div>
                    </td>                                            
                    <td>
                        <input type="text" class="form-control form-control-sm" name="guardian" value="{{ $data ? $data->guardian : '' }}" placeholder="Guardian name">
                        <div class="help-block text-red text-center" id="js-guardian">
                        </div>
                    </td>                                            
                    <td class="text-center">
                        <button type="submit" class="btn btn-sm btn-primary save">save</button>
                    </td>
                </tr>
            </form>
        @empty
            <th colspan="16" class="text-center">NO DATA FOUND</th>
        @endforelse                                
        <tr>
            <td colspan="16">
                <b>Female</b>
            </td>
        </tr>
        @forelse ($EnrollmentFemale as $key => $data) 
            <form class="js_demographic">
            {{ csrf_field() }}
                <tr>
                    <td>{{ $key + 1 }}.</td>
                    <td>{{ $data->student_name }}</td>
                    <td>
                        <input type="hidden" id="stud_id" name="stud_id" value="{{  $data->student_information_id }}" />
                        <div class="input-group date">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="far fa-calendar-alt"></i>
                                </span>
                            </div>
                            <input type="text" name="birthdate" class="datepicker form-control form-control-sm pull-right datails_input" id="datepicker{{ $key + 1 }}" value="{{ $data ? date_format(date_create( $data->birthdate), 'm/d/Y') : '' }}" placeholder="DOB">
                        </div>
                    </td>
                    <td>
                        <input type="text" class="form-control form-control-sm input-sm datails_input" name="age_june" id="age_june_{{ $data->id }}" value="{{ $data ? $data->age_june : '' }}" placeholder="Age">
                    </td>
                    <td>
                        <input type="text" class="form-control form-control-sm input-sm datails_input" name="age_may" value="{{ $data ? $data->age_may : '' }}" placeholder="Age">
                    </td>
                    <td>
                        <input type="text" class="form-control form-control-sm input-sm datails_input" name="address" value="{{ $data ? $data->c_address : '' }}" placeholder="Address">
                    </td>
                    <td>
                        <input type="text" class="form-control form-control-sm input-sm datails_input" name="guardian" value="{{ $data ? $data->guardian : '' }}" placeholder="Guardian name">
                    </td>
                    <td class="text-center">
                        <button type="submit" class="btn btn-sm btn-primary" >save</button>
                    </td>
                </tr>
            </form>
        @empty
            <th colspan="16" class="text-center">NO DATA FOUND</th>
        @endforelse
    </table>
</div>