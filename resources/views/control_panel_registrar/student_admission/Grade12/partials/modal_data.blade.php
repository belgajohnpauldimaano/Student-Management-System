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
            
                <div class="modal-body">                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Student Name</label>
                                <p>{{$Modal_data->student->last_name.', '.$Modal_data->student->first_name.' '.$Modal_data->student->middle_name}}</p>
                            </div> 
        
                            <div class="form-group">
                                <label for="">Student level</label>
                                <p>{{$Modal_data->payment_cat->stud_category->student_category.'-'.$Modal_data->payment_cat->grade_level_id}}</p>
                            </div>  

                            <div class="form-group">
                                <label for="">Email address</label>
                                <p>{{$Monthly_history->email}}</p>
                            </div>  
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Status</label><br/>
                                <span class="label {{ $Monthly_history->approval ? $Monthly_history->approval =='Approved' ? 'label-success' : 'label-danger' : 'label-danger'}}">
                                    {{ $Monthly_history->approval ? $Monthly_history->approval =='Approved' ? 'Approved' : 'Not yet approved' : 'Not yet approved'}}
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="">Payment option</label>
                                <p>{{$Monthly_history->payment_option}}</p>
                            </div>  
                            <div class="form-group">
                                <label for="">Phone number</label>
                                <p>{{$Monthly_history->number}}</p>
                            </div>  
                        </div>
                    </div>
                                        
                    <div class="box">
                        <div class="box-header ">
                            <p class="box-title">
                                Date and Time: {{ $Monthly_history ? date_format(date_create($Monthly_history->created_at), 'F d, Y h:i A') : '' }}
                            </p>
                        </div>
                        
                        <div class="box-body no-padding">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th>Description</th>
                                        <th>Amount</th>
                                        {{-- <th style="width: 40px">Label</th> --}}
                                    </tr>
                                    
                                    <tr>
                                        <td>Tuition Fee</td>
                                        <td>
                                            {{ number_format($Modal_data->payment_cat->tuition->tuition_amt, 2)}}
                                        </td>                                
                                    </tr>
                                    <tr>                                        
                                        <td>Misc Fee</td>
                                        <td>
                                            {{ number_format($Modal_data->payment_cat->misc_fee->misc_amt, 2)}}
                                        </td>                                
                                    </tr>   
                                    <tr>                                        
                                        <td>Sub Total</td>
                                        <td>
                                            {{ number_format($Modal_data->payment_cat->tuition->tuition_amt + $Modal_data->payment_cat->misc_fee->misc_amt, 2)}}
                                        </td>                                
                                    </tr>                                       
                                    <tr>
                                        <td>Less Discount Fee</td>
                                        <td>{{$Modal_data->disc_transaction_fee ? number_format($Modal_data->disc_transaction_fee->discount_amt,2) : '0.00'}}</td>
                                    </tr>
                                    <tr>
                                        
                                        <td>Total Fees</td>
                                        <td>
                                            @if($Modal_data->disc_transaction_fee)
                                                {{ number_format($Modal_data->payment_cat->tuition->tuition_amt + $Modal_data->payment_cat->misc_fee->misc_amt - $Modal_data->disc_transaction_fee->discount_amt, 2)}}
                                            @else
                                                {{ number_format($Modal_data->payment_cat->tuition->tuition_amt + $Modal_data->payment_cat->misc_fee->misc_amt, 2)}}
                                            @endif                                                
                                        </td>                                
                                    </tr>                                    
                                    <tr>                                        
                                        <td>Previous Balance</td>
                                        <td>
                                            @if($current_bal)
                                                @if($current_bal->balance==0)
                                                    @if($Modal_data->disc_transaction_fee)
                                                        {{ number_format($Modal_data->payment_cat->tuition->tuition_amt + $Modal_data->payment_cat->misc_fee->misc_amt - $Modal_data->disc_transaction_fee->discount_amt, 2)}}
                                                    @else
                                                        {{ number_format($Modal_data->payment_cat->tuition->tuition_amt + $Modal_data->payment_cat->misc_fee->misc_amt, 2)}}
                                                    @endif
                                                @else
                                                    @if($Modal_data->disc_transaction_fee)
                                                        {{ number_format($Modal_data->payment_cat->tuition->tuition_amt + $Modal_data->payment_cat->misc_fee->misc_amt - $Modal_data->disc_transaction_fee->discount_amt, 2)}}
                                                    @else
                                                        {{ number_format($Modal_data->payment_cat->tuition->tuition_amt + $Modal_data->payment_cat->misc_fee->misc_amt, 2)}}
                                                    @endif
                                                @endif
                                            @else
                                                {{ number_format($Modal_data->payment_cat->tuition->tuition_amt + $Modal_data->payment_cat->misc_fee->misc_amt, 2)}}
                                            @endif                                                                                                
                                        </td>                                    
                                    </tr>
                                    <tr>                                        
                                        <td>Payment</td>
                                        <td>
                                            {{ number_format($Monthly_history->payment, 2)}}
                                        </td>                                    
                                    </tr>
                                    <tr>
                                        
                                        <td>Balance</td>
                                        <td>
                                            {{ number_format($Monthly_history->balance, 2)}}
                                        </td>                                    
                                    </tr>
                                       
                                </tbody>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    

                        <div class="lightbox-target" id="img_receipt">
                            <img src="{{ $Monthly_history->receipt_img ? \File::exists(public_path('/img/receipt/'.$Monthly_history->receipt_img)) ?
                                asset('/img/receipt/'.$Monthly_history->receipt_img) : asset('/img/receipt/blank-user.gif') :
                                asset('/img/receipt/blank-user.gif') }}"/>
                            <a class="lightbox-close" href="#"></a>
                        </div>
                    
                        @if($Monthly_history->payment_option != 'Credit Card/Debit Card')
                            <div class="form-group">
                                <label for="">Image Receipt <small>(Click to zoom)</small></label>
                                <a class="lightbox" href="#img_receipt">
                                    <img class="img-responsive" 
                                    id="img-receipt"
                                    src="{{ $Monthly_history->receipt_img ? \File::exists(public_path('/img/receipt/'.$Monthly_history->receipt_img)) ?
                                    asset('/img/receipt/'.$Monthly_history->receipt_img) : asset('/img/receipt/blank-user.gif') :
                                    asset('/img/receipt/blank-user.gif') }}" 
                                    alt="User profile picture">
                                </a>
                            </div> 
                        @endif
                    </div>
                </div>            
                <div class="moda-footer">
                    <button class="btn btn-flat btn-{{ $Modal_data->approval ? $Modal_data->approval =='Approve' ? 'success btn-approve' : 'danger btn-disapprove' : 'success btn-approve'}} pull-right"
                         data-id="{{$Monthly_history->id}}">
                        {{ $Modal_data->approval ? $Modal_data->approval =='Approve' ? 'Approve' : 'Disapprove' : 'Approve'}}
                    </button>
                </div>     
            </div>    
            
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->