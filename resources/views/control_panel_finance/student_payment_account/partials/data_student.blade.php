<div class="row invoice-info">
    <div class="col-sm-3 invoice-col order-2 order-lg-1">
        <label for="">Username:</label> 
        <p style="margin-top: -5px">{{ $StudentInformation ? $StudentInformation->user->username : '' }}</p> 

        <label for="">Name: </label>    
        <p style="margin-top: -5px">{{ $StudentInformation ? $StudentInformation->full_name : '' }}</p>
        
        <label for="">Gender: </label>
        <p style="margin-top: -5px">{{ $StudentInformation ? $StudentInformation->gender == 1 ? 'Male' : 'Female' : ''}}</p>

        {{-- <label for="">Phone Number: </label>
        <p style="margin-top: -5px">{{ $StudentInformation ? $StudentInformation->contact_number == '' ? 'NA' : $StudentInformation->contact_number : ''}}</p> --}}
    </div>
    <!-- /.col -->
    <div class="col-sm-3 invoice-col order-3 order-lg-2">
        <label for="">Parent/Guardian: </label>
        <p style="margin-top: -5px">{{ $StudentInformation ? $StudentInformation->guardian == '' ? 'NA' : $StudentInformation->guardian : ''}}</p>

        <label for="">Date of Birth: </label>
        <p style="margin-top: -5px">{{ $StudentInformation ? date_format(date_create($StudentInformation->birthdate), 'm/d/Y') : '' }}</p>

        <label for="">Address: </label>
        <p style="margin-top: -5px">{{ $StudentInformation ? $StudentInformation->c_address == '' ? 'NA' :  $StudentInformation->c_address : ''}}</p>
    </div>
    <!-- /.col -->
    <div class="col-sm-3 invoice-col order-4 order-lg-3">
        <label for="">School Year: </label>
        <p style="margin-top: -5px">
            @php
                try {
                    echo $SchoolYear->school_year;
                } catch (\Throwable $th) {
                    echo $School_year_id;
                }
            @endphp
        </p>
        {{-- <input type="hidden" name="school_year_id" value="{{ $SchoolYear->school_year_id }}"> --}}

        <label for="">Payment Status: </label>
        <p style="margin-top: -5px">            
            @if($StudentInformation->finance_transaction)
                @if($StudentInformation->finance_transaction->school_year_id == $School_year_id)
                    <span class="badge {{ $StudentInformation->finance_transaction->status == 0 ? 'badge-success' : 'badge-danger' }}">
                        {{ $StudentInformation->finance_transaction->status == 0 ? 'Paid' : 'Not-Paid' }}
                    </span>
                @else
                    <span class="badge badge-danger">
                        Not-Paid
                    </span>
                @endif
            @else
                <span class="badge badge-danger">
                    Not-Paid
                </span>
            @endif            
        </p>
        
        <label for="">
            @php 
                try {
                    echo $Transaction->id ? 'Enrolled in ' : 'Incoming';
                } catch (\Throwable $th) {
                    echo 'Incoming';
                }   
            @endphp Grade-level:
        </label>

        <p style="margin-top: -5px">
            @php
                try {
                    echo $ClassDetail == '0' ? '' : $ClassDetail->section->section.' - ';
                } catch (\Throwable $th) {
                    echo 'No section assigned yet. Grade level - ';
                }
            @endphp
            {{ $grade_level_id ? $grade_level_id : 'none' }}
        </p>
        
    </div>
    <!-- /.col -->
    <div align="center" class="col-sm-3 invoice-col order-1 order-lg-4">
        <div class="form-group">
            @if ($Profile)
                <img class="profile-user-img img-responsive img-circle" id="img--user_photo" src="{{ $Profile->photo ? \File::exists(public_path('/img/account/photo/'.$Profile->photo)) ? asset('/img/account/photo/'.$Profile->photo) : asset('/img/account/photo/blank-user.gif') : asset('/img/account/photo/blank-user.gif') }}" style="width:150px; height:150px;  border-radius:50%;">
            @else
                <img class="profile-user-img img-responsive img-circle" id="img--user_photo" src="{{  asset('/img/account/photo/blank-user.png') }}" style="width:150px; height:150px;  border-radius:50%;">
            @endif
        </div>
    </div>
</div>