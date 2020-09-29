<form action="">
    <div class="box-body">
        <div class="js-data-school_year">
            <div class="form-group">
                <label>Finance</label>
                <select class="form-control" name="finance_sy">
                    <option>Select School year</option>
                    @foreach ($SchoolYear as $data)
                        <option value="{{$data->id}}">{{$data->school_year}}</option>                                
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Registrar</label>
               <select class="form-control" name="registrar_sy">
                    <option>Select School year</option>
                    @foreach ($SchoolYear as $data)
                        <option value="{{$data->id}}">{{$data->school_year}}</option>                                
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Student</label>
               <select class="form-control" name="student_sy">
                    <option>Select School year</option>
                    @foreach ($SchoolYear as $data)
                        <option value="{{$data->id}}">{{$data->school_year}}</option>                                
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="box-footer with-border">
        <button class="btn btn-flat btn-primary pull-right" type="submit">
            <i class="far fa-save"></i> Save
        </button>
    </div>
</form>