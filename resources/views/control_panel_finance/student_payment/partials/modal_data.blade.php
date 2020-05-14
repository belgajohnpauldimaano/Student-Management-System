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
                                <p>{{$Modal_data->email}}</p>
                            </div>  
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Status</label><br/>
                                <span class="label {{ $Modal_data->approval ? $Modal_data->approval =='Approved' ? 'label-success' : 'label-danger' : 'label-danger'}}">
                                    {{ $Modal_data->approval ? $Modal_data->approval =='Approved' ? 'Approved' : 'Not yet approved' : 'Not yet approved'}}
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="">Payment option</label>
                                <p>{{$Modal_data->payment_option}}</p>
                            </div>  
                            <div class="form-group">
                                <label for="">Phone number</label>
                                <p>{{$Modal_data->number}}</p>
                            </div>  
                        </div>
                    </div>
                                        
                   
                        
                    <div class="box-body ">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
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
                                    </tr>
                                    <tr>
                                        <td>2.</td>
                                        <td>Misc Fee</td>
                                        <td>
                                            {{ number_format($Modal_data->payment_cat->misc_fee->misc_amt, 2)}}
                                        </td>                                
                                    </tr>
                                    <tr>
                                        <td>3.</td>
                                        <td>Total Fees</td>
                                        <td>
                                            {{ number_format($Modal_data->payment_cat->tuition->tuition_amt + $Modal_data->payment_cat->misc_fee->misc_amt, 2)}}
                                        </td>                                
                                    </tr>
                                    <tr>
                                        <td>4.</td>
                                        <td>Payment</td>
                                        <td>
                                            {{ number_format($Modal_data->downpayment, 2)}}
                                        </td>                                    
                                    </tr>
                                    <tr>
                                        <td>5.</td>
                                        <td>Balance</td>
                                        <td>
                                            {{ number_format($Modal_data->payment_cat->tuition->tuition_amt, 2)}}
                                        </td>                                    
                                    </tr>
                            </tbody>
                        </table>
                    </div>
                        <!-- /.box-body -->
                    

                    <div class="lightbox-target" id="img_receipt">
                        <img src="{{ $Modal_data->receipt_img ? \File::exists(public_path('/img/receipt/'.$Modal_data->receipt_img)) ?
                            asset('/img/receipt/'.$Modal_data->receipt_img) : asset('/img/receipt/blank-user.gif') :
                            asset('/img/receipt/blank-user.gif') }}"/>
                        <a class="lightbox-close" href="#"></a>
                    </div>
                    
                    @if($Modal_data->payment_option != 'Credit Card/Debit Card')
                        <div class="form-group">
                            <label for="">Image Receipt <small>(Click to zoom)</small></label>
                            <a class="lightbox" href="#img_receipt">
                                <img class="img-responsive" 
                                id="img-receipt"
                                src="{{ $Modal_data->receipt_img ? \File::exists(public_path('/img/receipt/'.$Modal_data->receipt_img)) ?
                                asset('/img/receipt/'.$Modal_data->receipt_img) : asset('/img/receipt/blank-user.gif') :
                                asset('/img/receipt/blank-user.gif') }}" 
                                alt="User profile picture">
                            </a>
                        </div> 
                    @endif
                </div>           
                <div class="moda-footer">
                    <button class="btn btn-success btn-flat btn-approve pull-right" data-id="{{$Modal_data->id}}">
                        {{ $Modal_data->approval ? $Modal_data->approval =='Approved' ? 'Disapprove' : 'Approve' : 'Disapprove'}}
                    </button>
                </div>     
            </div>    
            
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->