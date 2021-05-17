<table class="table-student-info" style="font-size: 14px !important">
        <thead>
            <tr>
                <td colspan="2">
                    <p class="m0"><small>SY:</small> 
                        <b>
                            @php
                                try {
                                    echo $data['school_year'];
                                } catch (\Throwable $th) {
                                    echo $school_year;
                                }
                            @endphp
                        </b>
                    </p>
                </td>
                {{-- <td>&nbsp;</td> --}}
            </tr>
            <tr>
                @php
                    $grade;
                    try {
                        $grade = $data['grade_level'];
                    } catch (\Throwable $th) {
                        $grade = $grade_level;
                    }
                @endphp
                <td>
                    <p class="m0">I am Incoming: 
                        <b>Grade 
                            {{ $grade }}
                        </b>
                    </p>
                </td>
                @if($grade == 11)
                <td>
                    <p class="m0">Strand:
                        <b>
                            @php
                                try {
                                    echo $data['strand'];
                                } catch (\Throwable $th) {
                                    echo $strand;
                                }
                            @endphp
                        </b>
                    </p>
                </td>
                @endif
            </tr>
            <tr>
                <td>
                    <p class="m0">LRN: 
                        <b class="" style="width: 50% !important;">
                            @php
                                try {
                                    echo $data['username'];
                                } catch (\Throwable $th) {
                                    echo $username;
                                }
                            @endphp
                        </b>
                    </p> 
                </td>
                <td>
                    <p class="m0">Fb/Messenger Account: 
                        <b>
                            @php
                                try {
                                    echo $data['fb_acct'];
                                } catch (\Throwable $th) {
                                    echo $fb_acct;
                                }
                            @endphp
                        </b>
                    </p>
                </td>
            </tr>            
        </thead>
    </table>
    <h4 class="m3"><b>PERSONAL DATA</b></h4>
    <table class="table-student-info">
        <thead>
            <tr>
                <td style="width: 33.333% !important">
                    <p class="m2 box-field">
                        <b>
                            @php
                                try {
                                    echo $data['l_name'];
                                } catch (\Throwable $th) {
                                    echo $l_name;
                                }
                            @endphp
                        </b>
                    </p><br/>Last Name
                </td>
                <td  style="width: 33.333% !important">
                    <p class="m2 box-field">
                        <b>
                            @php
                                try {
                                    echo $data['f_name'];
                                } catch (\Throwable $th) {
                                    echo $f_name;
                                }
                            @endphp    
                        </b>
                    </p><br/>Given Name
                </td>
                <td  style="width: 33.333% !important">
                    <p class="m2 box-field">
                        <b>
                            @php
                                try {
                                    echo $data['m_name'];
                                } catch (\Throwable $th) {
                                    echo $m_name;
                                }
                            @endphp
                        </b>
                    </p><br/>Middle Name
                </td>
                {{-- <td>&nbsp;</td> --}}
            </tr>
        </thead>
    </table>
    <table class="table-student-info">
        <thead>            
            <tr>
                <td colspan="4">
                    <p class="m2 box-field w-100">
                        <b>
                            @php
                                try {
                                    echo $data['p_address'];
                                } catch (\Throwable $th) {
                                    echo $p_address;
                                }
                            @endphp
                        </b>
                    </p>
                    <br/>
                    Permanent Address (House No. Brgy./Street Municipality Province)
                </td>
            </tr>
            <tr>
                <td style="width: 33% !important">
                    <p class="m2 box-field">
                        <b>
                            @php
                                try {
                                    echo $data['birthdate'];
                                } catch (\Throwable $th) {
                                    echo $birthdate;
                                }
                            @endphp
                        </b>
                    </p><br/>Date of Birth
                </td>
                <td style="width: 33% !important">
                    <p class="m2 box-field">
                        <b>
                            @php
                                try {
                                    echo $data['place_of_birth'];
                                } catch (\Throwable $th) {
                                    echo $place_of_birth;
                                }
                            @endphp
                        </b>
                    </p><br/>Place of Birth
                </td>
                <td style="width: 15% !important">
                    <p class="m2 box-field">
                        <b>
                            @php
                                try {
                                    echo $data['age'];
                                } catch (\Throwable $th) {
                                    echo $age;
                                }
                            @endphp
                        </b>
                    </p><br/>Age
                </td>
                <td style="width: 15% !important">
                    <p class="m2 box-field">
                        <b>
                            @php
                                try {
                                    echo $data['gender'];
                                } catch (\Throwable $th) {
                                    echo $gender;
                                }
                            @endphp
                        </b>
                    </p><br/>Gender
                </td>
            </tr>
        </thead>
    </table>
    <table class="table-student-info">
        <thead>
            <tr>
                <td style="width: 25% !important">
                    <p class="m2 box-field">
                        <b>
                            @php
                                try {
                                    echo $data['religion'];
                                } catch (\Throwable $th) {
                                    echo $religion;
                                }
                            @endphp
                        </b>
                    </p><br/>Religion
                </td>
                <td style="width: 25% !important">
                    <p class="m2 box-field">
                        <b>
                            @php
                                try {
                                    echo $data['citizenship'];
                                } catch (\Throwable $th) {
                                    echo $citizenship;
                                }
                            @endphp
                        </b>
                    </p><br/>Citizenship
                </td>
                <td style="width: 25% !important">
                    <p class="m2 box-field">
                        <b>
                            @php
                                try {
                                    echo $data['email'];
                                } catch (\Throwable $th) {
                                    echo $email;
                                }
                            @endphp
                        </b>
                    </p><br/>Email address
                </td>
                <td style="width: 25% !important">
                    <p class="m2 box-field">
                        <b>
                            @php
                                try {
                                    echo $data['contact_number'];
                                } catch (\Throwable $th) {
                                    echo $contact_number;
                                }
                            @endphp
                        </b>
                    </p><br/>Phone number
                </td>
            </tr>            
        </thead>
    </table>
    
    <h4 class="m3"><b>EDUCATIONAL DATA</b></h4>
    <table class="table-student-info">
        <thead>
            <tr>
                <td colspan="2" style="width: 70% !important">
                    <p class="m2 box-field">
                        <b>
                            @php
                                try {
                                    echo $data['school_name'];
                                } catch (\Throwable $th) {
                                    echo $school_name;
                                }
                            @endphp
                        </b>
                    </p><br/>Name of School
                </td>
                <td  style="width: 30% !important">
                    <p class="m2 box-field">
                        <b>
                            @php
                                try {
                                    echo $data['school_type'];
                                } catch (\Throwable $th) {
                                    echo $school_type;
                                }
                            @endphp
                        </b>
                    </p><br/>School Type
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <p class="m2 box-field w-100">
                        <b>
                            @php
                                try {
                                    echo $data['school_address'];
                                } catch (\Throwable $th) {
                                    echo $school_address;
                                }
                            @endphp
                        </b>
                    </p><br/>School Address
                </td>
            </tr>
            <tr>
                <td style="width: 60% !important">
                    <p class="m2 box-field">
                        <b>
                            @php
                                try {
                                    echo $data['last_sy_attended'];
                                } catch (\Throwable $th) {
                                    echo $last_sy_attended;
                                }
                            @endphp
                        </b>
                    </p><br/>Last School Year Attended:
                </td>
                <td  style="width: 30% !important">
                    <p class="m2 box-field">
                        <b>
                            @php
                                try {
                                    echo $data['gw_average'];
                                } catch (\Throwable $th) {
                                    echo $gw_average;
                                }
                            @endphp
                        </b>
                    </p><br/>Average(GWA)
                </td>
                <td  style="width: 10% !important">
                    <p class="m2 box-field">
                        <b>
                            @php
                                try {
                                    echo $data['is_esc'];
                                } catch (\Throwable $th) {
                                    echo $is_esc;
                                }
                            @endphp
                        </b>
                    </p><br/>ESC grantee
                </td>
            </tr>
        </thead>
    </table>

    <h4 class="m3"><b>FAMILY DATA</b></h4>
    <table class="table-student-info">
        <thead>
            <tr>
                <td colspan="2">
                    <p class="m2 box-field w-100">
                        <b>
                            @php
                                try {
                                    echo $data['father_name'];
                                } catch (\Throwable $th) {
                                    echo $father_name;
                                }
                            @endphp
                        </b>
                    </p><br/>Father's Name
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <p class="m2 box-field w-100">
                        <b>
                            @php
                                try {
                                    echo $data['father_occupation'];
                                } catch (\Throwable $th) {
                                    echo $father_occupation;
                                }
                            @endphp
                        </b>
                    </p><br/>Occupation
                </td>
                
            </tr>
            <tr>
                <td style="width: 50% !important">
                    <p class="m2 box-field">
                        <b>
                            @php
                                try {
                                    echo $data['father_fb_acct'];
                                } catch (\Throwable $th) {
                                    echo $father_fb_acct;
                                }
                            @endphp
                        </b>
                    </p><br/>FB/Messenger Acct
                </td>
                <td style="width: 50% !important">
                    <p class="m2 box-field">
                        <b>
                            @php
                                try {
                                    echo $data['father_contact'];
                                } catch (\Throwable $th) {
                                    echo $father_contact;
                                }
                            @endphp
                        </b>
                    </p><br/>Contact No.
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <p class="m2 box-field w-100">
                        <b>
                            @php
                                try {
                                    echo $data['mother_name'];
                                } catch (\Throwable $th) {
                                    echo $mother_name;
                                }
                            @endphp
                        </b>
                    </p><br/>Mother's Name
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <p class="m2 box-field w-100">
                        <b>
                            @php
                                try {
                                    echo $data['mother_occupation'];
                                } catch (\Throwable $th) {
                                    echo $mother_occupation;
                                }
                            @endphp
                        </b>
                    </p><br/>Occupation
                </td>
            </tr>
            <tr>
                <td style="width: 50% !important">
                    <p class="m2 box-field">
                        <b>
                            @php
                                try {
                                    echo $data['mother_fb_acct'];
                                } catch (\Throwable $th) {
                                    echo $mother_fb_acct;
                                }
                            @endphp
                        </b>
                    </p><br/>FB/Messenger Acct
                </td>
                <td style="width: 50% !important">
                    <p class="m2 box-field">
                        <b>
                            @php
                                try {
                                    echo $data['mother_contact'];
                                } catch (\Throwable $th) {
                                    echo $mother_contact;
                                }
                            @endphp
                        </b>
                    </p><br/>Contact No.
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <p class="m2 box-field">
                        <b>
                            @php
                                try {
                                    echo $data['guardian'];
                                } catch (\Throwable $th) {
                                    echo $guardian;
                                }
                            @endphp
                        </b>
                    </p><br/>Parent/Guardian
                </td>
            </tr>
            <tr>
                <td style="width: 50% !important">
                    <p class="m2 box-field">
                        <b>
                            @php
                                try {
                                    echo $data['guardian_fb_acct'];
                                } catch (\Throwable $th) {
                                    echo $guardian_fb_acct;
                                }
                            @endphp
                        </b>
                    </p><br/>FB/Messenger Acct
                </td>
                <td style="width: 50% !important">
                    <p class="m2 box-field">
                        <b>
                            @php
                                try {
                                    echo $data['guardian_contact'];
                                } catch (\Throwable $th) {
                                    echo $guardian_contact;
                                }
                            @endphp
                        </b>
                    </p><br/>Contact No.
                </td>
            </tr>
            <tr>
                <td colspan="2" style="width: 30% !important">
                    Number of siblings <i>(applicant is not included)</i> <span class="m2 box-field" style="width: 20% !important">
                        <b>
                            @php
                                try {
                                    echo $data['no_siblings'];
                                } catch (\Throwable $th) {
                                    echo $no_siblings;
                                }
                            @endphp
                        </b>
                    </span>
                </td>
            </tr>
        </thead>
    </table>

    <h4 class="m3"><b>STUDENT SCHOLAR TYPE</b></h4>
    @php
        $scholar_types = array(
            ['id' => 1, 'type' => "Employee's Child"],
            ['id' => 2, 'type' => "With High Honors"],
            ['id' => 3, 'type' => "With Highest Honors"],
            ['id' => 4, 'type' => "ESC Grantee"],
            ['id' => 5, 'type' => "Sibling Discount"]
        );
        json_encode($scholar_types);
    @endphp
    <div class="m2">
        <table class="table-student-info">
            <tr>
                @foreach($scholar_types as $key => $checkbox)
                    <td>
                        <div class="" >
                            <input style="input[type='text'][disabled] {
                                    background-color: #EBEBE4 !important;
                                }"
                                disabled
                                type="checkbox" name="scholar_type[]" 
                                class="form-check-input" id="scholar_type-{{$key}}" 
                                value="{{ $checkbox['type'] }}" 
                                @php
                                    try {
                                        $selected = \App\Models\StudentScholarType::where('student_information_id', $data['student_id'])
                                            ->where('name', $checkbox['type'])->first();
                                    } catch (\Throwable $th) {
                                        $selected = \App\Models\StudentScholarType::where('student_information_id', $student_id)
                                            ->where('name', $checkbox['type'])->first();
                                    }
                                    
                                @endphp
                                {{ $selected ? 'checked' : '' }} 
                            >
                            <label class="form-check-label" for="check-box-{{$key}}">
                                {{ $checkbox['type']}}
                            </label>
                        </div>
                    </td>
                @endforeach
            </tr>
        </table>
    </div>

    <h4 class="m3"><b>NAME OF BROTHER'S & SISTER(S) WHO ARE CURRENTLY ENROLLED</b></h4>
    
    <div class="m2">
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th class="text-center">Grade</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    try {
                ?>
                    @forelse ($data['siblings'] as $sibling)
                        <tr>
                            <td>{{ $sibling->name }}</td>
                            <td class="text-center">{{ $sibling->grade_level_id }}</td>
                        </tr>
                    @empty
                        <tr>
                            <th class="text-center" colspan="2">No Data</th class="text-center">
                        </tr>
                    @endforelse
                <?php
                    } catch (\Throwable $th) {
                        echo '<tr><th class="text-center" colspan="2">No Data</th class="text-center"></tr>';
                    }
                ?>
            </tbody>
        </table>
    </div>