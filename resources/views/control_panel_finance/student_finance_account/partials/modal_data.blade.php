<div class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            {{-- <div class="box-body"> --}}
                <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>                            
                        <h4 style="margin-right: 5em;" class="modal-title">
                            Student Payment Account Information
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
                                <p>{{$Modal_data->monthly->email}}</p>
                            </div>  
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Status</label><br/>
                                <span class="label {{ $Modal_data->status ? $Modal_data->status ==0 ? 'label-success' : 'label-danger' : 'label-success'}}">
                                    {{ $Modal_data->status ? $Modal_data->status == 0 ? 'Paid' : 'Not yet paid' : 'Paid'}}
                                    {{-- {{ $Modal_data->status ? $Modal_data->status == 0 ? 'Unpaid' : 'Paid' : 'Unpaid'}} --}}
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="">Payment option</label>
                                <p>{{$Modal_data->monthly->payment_option}}</p>
                            </div>  
                            <div class="form-group">
                                <label for="">Phone number</label>
                                <p>{{$Modal_data->monthly->number}}</p>
                            </div>  
                        </div>
                    </div>
                                        
                    <div class="box">
                        <div class="box-header ">
                            <p class="box-title">
                                Student Account
                            </p>
                        </div>
                        
                        <div class="box-body no-padding">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th style="width: 50%">Description</th>
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
                                            <td>Discount Fee</td>
                                            <td>{{$Modal_data->disc_transaction_fee ? number_format($Modal_data->disc_transaction_fee->discount_amt,2) : '0.00'}}</td>
                                        </tr>
                                        <tr>
                                            <td>4.</td>
                                            <td>Total Fees</td>
                                            <td>
                                                @if($Modal_data->disc_transaction_fee)
                                                    {{ number_format($Modal_data->payment_cat->tuition->tuition_amt + $Modal_data->payment_cat->misc_fee->misc_amt - $Modal_data->disc_transaction_fee->discount_amt, 2)}}
                                                @else
                                                    {{ number_format($Modal_data->payment_cat->tuition->tuition_amt + $Modal_data->payment_cat->misc_fee->misc_amt, 2)}}
                                                @endif                                                
                                            </td>                                
                                        </tr>
                                    </tbody>
                            </table>
                        </div>
                    </div>
                     
                    {{-- TRANSACTION HISTORY --}}
                    <h4>Transaction History</h4>
                    <div class="box">
                        @foreach ($Mo_history as $data)                        
                            <div class="box-header ">
                                <p class="box-title">
                                    Date and Time: {{ $data ? date_format(date_create($data->created_at), 'F d, Y h:i A') : '' }}
                                </p>
                                <br>Status: 
                                <span class="label {{ $data->approval ? $data->approval == 'Approved' ? 'label-success' : 'label-danger' : 'label-danger'}}">
                                    {{ $data->approval ? $data->approval == 'Approved' ? 'Approved' : 'Not yet Approved' : 'Not yet Approved'}}
                                </span>
                            </div>
                                
                            <div class="box-body no-padding">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th style="width: 50%">Description</th>
                                            <th>Amount</th>
                                            {{-- <th style="width: 40px">Label</th> --}}
                                        </tr>
                                        <tr>
                                            <td>1.</td>
                                                <td>Payment Option</td>
                                                <td>
                                                    {{ $data->payment_option}}
                                                </td>                                
                                            </tr>
                                            <td>2.</td>
                                                <td>Tuition Fee</td>
                                                <td>
                                                    {{ number_format($data->payment, 2)}}
                                                </td>                                
                                            </tr>
                                            <tr>
                                                <td>3.</td>
                                                <td>Misc Fee</td>
                                                <td>
                                                    {{ number_format($data->balance, 2)}}
                                                </td>                                
                                            </tr>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="lightbox-target" id="img_receipt">
                                <img src="{{ $data->receipt_img ? \File::exists(public_path('/img/receipt/'.$data->receipt_img)) ?
                                    asset('/img/receipt/'.$data->receipt_img) : 
                                    asset('/img/receipt/blank-user.gif') :
                                    asset('/img/receipt/blank-user.gif') }}"/>
                                <a class="lightbox-close" href="#"></a>
                            </div>
                        
                            @if($data->payment_option != 'Credit Card/Debit Card')
                                <div class="form-group" style="margin-top: 10px">
                                    <label for="">Image Receipt <small>(Click to zoom)</small></label>
                                    <a class="lightbox" href="#img_receipt">
                                        <img class="img-responsive" 
                                        id="img-receipt"
                                        src="{{ $data->receipt_img ? \File::exists(public_path('/img/receipt/'.$data->receipt_img)) ?
                                        asset('/img/receipt/'.$data->receipt_img) : 
                                        asset('/img/receipt/blank-user.gif') :
                                        asset('/img/receipt/blank-user.gif') }}" 
                                        alt="User profile picture">
                                    </a>
                                </div> 
                            @endif
                            </div>                        
                        @endforeach
                        <div class="modal-footer">
                        <button class="btn btn-flat  {{ $Modal_data->status ? $Modal_data->status == 0 ? 'btn-danger btn-unpaid' : 'btn-success btn-paid' : 'btn-danger btn-unpaid'}} pull-right" data-id="{{$Modal_data->id}}">
                                {{ $Modal_data->status ? $Modal_data->status == 0 ? 'Unpaid' : 'Paid' : 'Unpaid'}}
                            </button>
                        </div> 
                    </div> 
                                       
                </div>
                
            {{-- </div>    --}}
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->