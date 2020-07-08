<div class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="js-form_payment_category">
                {{ csrf_field() }}
                @if ($PaymentCategory)
                    <input type="hidden" name="id" value="{{ $PaymentCategory->id }}">
                @endif
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">
                        {{ $PaymentCategory ? 'Edit Monthly Fee' : 'Add Monthly Fee' }}
                    </h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Student Category</label>
                        <select name="stud_cat" id="stud_cat" class="form-control">
                            <option value="">Select Student Category</option>
                            @if($StudentCategory)
                                @foreach($StudentCategory as $student_cat)
                                    <option value="{{$student_cat->id}}" {{ $PaymentCategory ? $PaymentCategory->student_category_id == $student_cat->id ? 'selected' : '' : '' }}> Category {{ $student_cat->student_category }}</option>                    
                                @endforeach
                            @endif
                        </select>
                        <div class="help-block text-red text-center" id="js-stud_cat">
                        </div>                        
                    </div>
                    <div class="form-group">
                        <label for="">Grade lvl</label>
                        <select name="gradelvl" id="gradelvl" class="form-control">
                            <option value="">Select Grade level</option>
                            @if($Gradelvl)
                                @foreach($Gradelvl as $grade_lvl)
                                    <option value="{{$grade_lvl->id}}" {{ $PaymentCategory ? $PaymentCategory->grade_level_id == $grade_lvl->id ? 'selected' : '' : '' }}> Grade {{ $grade_lvl->grade }}</option>                    
                                @endforeach
                            @endif
                        </select>
                        <div class="help-block text-red text-center" id="js-gradelvl">
                        </div>                        
                    </div>

                    <div class="form-group">
                            <label for="">Tuition Fee</label>
                            <select name="tuitionfee" id="tuitionfee" class="form-control">
                                
                                @if($TuitionFee)
                                <option value="">Select Tuition Fee</option>
                                    @foreach($TuitionFee as $tf)
                                        <option value="{{$tf->id}}" {{ $PaymentCategory ? $PaymentCategory->tuition_fee_id == $tf->id ? 'selected' : '' : '' }}> {{ number_format($tf->tuition_amt, 2) }}</option>
                                        {{-- <option value="{{ $data->id }}" {{ $ClassDetail ? $ClassDetail->section_id == $data->id ? 'selected' : '' : '' }}>{{ $data->section }}</option>                   --}}
                                    @endforeach
                                @endif
                            </select>
                            <div class="help-block text-red text-center" id="js-tuitionfee">
                            </div>
                    </div>

                    <div class="form-group">
                        <label for="">Miscelleneous Fee</label>
                        <select name="misc_fee" id="misc_fee" class="form-control">
                            <option value="">Select Miscelleneous Fee</option>
                            @if($MiscFee)
                                @foreach($MiscFee as $misc)
                                    <option value="{{$misc->id}}" {{ $PaymentCategory ? $PaymentCategory->misc_fee_id == $misc->id ? 'selected' : '' : '' }}> {{ number_format($misc->misc_amt, 2) }}</option>                    
                                @endforeach
                            @endif
                        </select>
                        <div class="help-block text-red text-center" id="js-misc_fee">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Other Fee</label>
                        <select name="other_fee" id="other_fee" class="form-control">
                            <option value="">Select Other Fee</option>
                            @if($OtherFee)
                                @foreach($OtherFee as $other)
                                    <option value="{{$other->id}}" {{ $PaymentCategory ? $PaymentCategory->other_fee_id == $other->id ? 'selected' : '' : '' }}> {{ number_format($other->other_fee_amt, 2) }}</option>                    
                                @endforeach
                            @endif
                        </select>
                        <div class="help-block text-red text-center" id="js-other_fee">
                        </div>
                    </div>

                    
                    {{-- <div class="form-group">
                        <label for="">Total of Months</label>
                        <select name="total_months" id="total_months" class="form-control">
                            <option value="">Select total no. of months</option>
                            <option value="5" {{ $PaymentCategory ? $PaymentCategory->months == 5 ? 'selected' : '' : '' }}>5 months</option>
                            <option value="10" {{ $PaymentCategory ? $PaymentCategory->months == 10 ? 'selected' : '' : '' }}>10 months</option>
                        </select>
                        <div class="help-block text-red text-center" id="js-total_months">
                        </div>
                    </div>                    --}}
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-flat">Save</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->