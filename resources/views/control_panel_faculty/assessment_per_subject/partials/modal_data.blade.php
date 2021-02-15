<div class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <form id="js-form_disc_fee">
                {{ csrf_field() }}
                @if ($ClassSubjectDetail)
                    <input type="hidden" name="id" value="{{ $ClassSubjectDetail->id }}">
                @endif
                <div class="modal-header">
                    <h4 class="modal-title">
                        Add Assessment
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Title</label>
                        <input type="text" class="form-control form-control-sm" name="title" value="">
                        <div class="help-block text-red text-center" id="js-title">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Date Time will publish: </label>
                                <div class="input-group date">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="far fa-calendar-alt"></i>
                                    </span>
                                    </div>
                                    <input type="text" name="publish-date-time" class="form-control form-control-sm pull-right"  
                                    data-date-format="yyyy-mm-dd hh:ii" id="publishdatetime" >
                                </div>
                                <div class="help-block text-red text-center" id="js-publish-date-time">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="">Date Time expiration: </label>
                                {{--  <input type="text" class="form-control" name="birthdate" value="{{ $StudentInformation ? $StudentInformation->birthdate : '' }}">  --}}
                                <div class="input-group date">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="far fa-calendar-alt"></i>
                                    </span>
                                    </div>
                                    <input type="text" name="exp-date-time" class="form-control form-control-sm pull-right" 
                                    data-date-format="yyyy-mm-dd hh:ii" id="expdatetime" >
                                </div>
                                <div class="help-block text-red text-center" id="js-exp-date-time">
                                </div>
                            </div>
                            {{-- <div class="col-md-2">
                                <div class="form-group">
                                    <label for="">PTS</label>
                                    <input type="number" class="form-control form-control-sm" name="pts" value="0">
                                    <div class="help-block text-red text-center" id="js-pts">
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                    
                    @if($ClassSubjectDetail->classDetail->grade->id > 10)
                    <div class="form-group form-group-sm w-100">
                        <label>Semester Period</label>
                        <select class="form-control select2" style="width: 100%;">
                            <option>1st semester</option>
                            <option>2nd semester</option>
                        </select>
                    </div>
                    @endif
                    <div class="form-group form-group-sm w-100">
                        <label>Quarter Period</label>
                        <select class="form-control select2" style="width: 100%;">
                            <option>1st quarter</option>
                            <option>2nd quarter</option>
                            @if($ClassSubjectDetail->classDetail->grade->id < 11)
                            <option>3rd quarter</option>
                            <option>4th quarter</option>
                            @endif
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default " data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary ">Create</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->