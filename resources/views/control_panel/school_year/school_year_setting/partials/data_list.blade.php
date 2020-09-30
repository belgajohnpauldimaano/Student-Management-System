<form id="set-school-year-form">
    <div class="box-body">
        {{ csrf_field() }}

        <div class="form-group">
            <label>Finance</label>
            <select class="form-control" name="finance" id="finance">
                <option value="">Select School year</option>
                @foreach ($SchoolYear as $data)
                    <option value="{{$data->id}}" {{$finance->school_year_id == $data->id ? 'selected' : ''}}>{{$data->school_year}}</option>                                
                @endforeach
            </select>
            <div class="help-block text-red text-left" id="js-finance">
            </div>
        </div>            

        <div class="form-group">
            <label>Registrar</label>
            <select class="form-control" name="registrar" id="registrar">
                <option value="">Select School year</option>
                @foreach ($SchoolYear as $data)
                    <option value="{{$data->id}}" {{$registrar->school_year_id == $data->id ? 'selected' : ''}}>{{$data->school_year}}</option>                                
                @endforeach
            </select>
            <div class="help-block text-red text-left" id="js-registrar">
            </div>
        </div>

        <div class="form-group">
            <label>Student</label>
            <select class="form-control" name="student" id="student">
                <option value="">Select School year</option>
                @foreach ($SchoolYear as $data)
                    <option value="{{$data->id}}" {{$student->school_year_id == $data->id ? 'selected' : ''}}>{{$data->school_year}}</option>                                
                @endforeach
            </select>
            <div class="help-block text-red text-left" id="js-student">
            </div>
        </div>

        <div class="form-group">
            <label>Faculty</label>
            <select class="form-control" name="faculty" id="faculty">
                <option value="">Select School year</option>
                @foreach ($SchoolYear as $data)
                    <option value="{{$data->id}}" {{$faculty->school_year_id == $data->id ? 'selected' : ''}}>{{$data->school_year}}</option>                                
                @endforeach
            </select>
            <div class="help-block text-red text-left" id="js-faculty">
            </div>
        </div>
    </div>
    
    <div class="box-footer with-border">
        <button class="btn btn-flat btn-primary pull-right" type="submit">
            <i class="far fa-save"></i> Save
        </button>
    </div>
</form>