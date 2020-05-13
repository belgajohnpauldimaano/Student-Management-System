<div class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="box-body">
                <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>                            
                        <h4 style="margin-right: 5em;" class="modal-title">
                            Student Payment Information
                        </h4>
                </div>
            </div> 
            <div class="modal-body">
                
                <div class="form-group">
                    <label for="">Student Name</label>
                    <p>{{$Modal_data->student->last_name.', '.$Modal_data->student->first_name.' '.$Modal_data->student->middle_name}}</p>
                </div> 

                <div class="form-group">
                    <label for="">Student level</label>
                    <p>{{$Modal_data->payment_cat->stud_category->student_category.'-'.$Modal_data->payment_cat->grade_level_id}}</p>
                </div>  

                <div class="form-group">
                    <label for="">Status</label>
                    <span class="label {{ $Modal_data->approval ? $Modal_data->approval =='Approved' ? 'label-success' : 'label-danger' : 'label-danger'}}">
                        {{ $Modal_data->approval ? $Modal_data->approval =='Approved' ? 'Approved' : 'Not yet approved' : 'Not yet approved'}}
                    </span>
                </div>
                
                
                <div class="form-group">
                    <label for="">Payment option</label>
                    <p>{{$Modal_data->payment_option}}</p>
                </div>  

                <table class="table table-bordered">
                    <tbody><tr>
                      <th style="width: 10px">#</th>
                      <th>Description</th>
                      <th>Amount</th>
                      {{-- <th style="width: 40px">Label</th> --}}
                    </tr>
                    <tr>
                      <td>1.</td>
                      <td>Tuition Fee</td>
                      <td>
                        {{ number_format($Modal_data->payment_cat->tuition->tuition_amt, 2)}}
                      </td>
                      {{-- <td><span class="badge bg-red">55%</span></td> --}}
                    </tr>
                    <tr>
                      <td>2.</td>
                      <td>Misc Fee</td>
                      <td>
                        {{ number_format($Modal_data->payment_cat->misc_fee->misc_amt, 2)}}
                      </td>
                      {{-- <td><span class="badge bg-yellow">70%</span></td> --}}
                    </tr>
                    <tr>
                      <td>3.</td>
                      <td>Total Fees</td>
                      <td>
                        {{ number_format($Modal_data->payment_cat->tuition->tuition_amt + $Modal_data->payment_cat->misc_fee->misc_amt, 2)}}
                      </td>
                      {{-- <td><span class="badge bg-light-blue">30%</span></td> --}}
                    </tr>
                    <tr>
                      <td>4.</td>
                      <td>Payment</td>
                      <td>
                        {{ number_format($Modal_data->downpayment, 2)}}
                      </td>
                      {{-- <td><span class="badge bg-green">90%</span></td> --}}
                    </tr>
                    <tr>
                        <td>5.</td>
                        <td>Balance</td>
                        <td>
                            {{ number_format($Modal_data->payment_cat->tuition->tuition_amt, 2)}}
                        </td>
                        {{-- <td><span class="badge bg-green">90%</span></td> --}}
                      </tr>
                  </tbody>
                </table>
                @if($Modal_data->payment_option != 'Credit Card/Debit Card')
                    <div class="form-group">
                        <label for="">Image Receipt</label>
                        <img class="img-responsive"
                        id="img-receipt"
                        src="{{ $Modal_data->receipt_img ? \File::exists(public_path('/img/receipt/'.$Modal_data->receipt_img)) ?
                        asset('/img/receipt/'.$Modal_data->receipt_img) : asset('/img/receipt/blank-user.gif') :
                        asset('/img/receipt/blank-user.gif') }}" 
                        alt="User profile picture">
                    </div> 
                @endif
            </div>           
            <div class="moda-footer">

            </div>           
            
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->