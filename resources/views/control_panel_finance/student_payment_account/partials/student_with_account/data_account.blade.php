
    @include('control_panel_finance.student_payment_account.partials.student_with_account.data_status')
    
    <div style="margin-botton: 100px">
        <button type="button" class="pull-right btn btn-flat btn-primary btn-md" data-id="{{ $StudentInformation->id }}" id="js-button-payment">
            <i class="fas fa-plus"></i> Add Payment
        </button>
            
        <div class="nav-tabs-custom"  style="; margin-top: 20px">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#history" data-toggle="tab">Transaction(s)</a>
                </li>
                <li>
                    <a href="#others-history" data-toggle="tab">Other(s)</a>
                </li>
                <li>
                    <a href="#discount-history" data-toggle="tab">Discount(s)</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="active tab-pane" id="history">
                    @include('control_panel_finance.student_payment_account.partials.student_with_account.data_history')   
                </div>
                
                <div class="tab-pane" id="others-history">
                    <h3>Other(s) Payment</h3>
                    
                    <div class="row">
                        @if($AccountOthers)
                            
                            <!-- /.box-header -->
                            <div class="box-body no-padding">
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Transaction ID</th>
                                            <th>OR No.</th>
                                            <th>Description</th>
                                            <th>Qty</th>
                                            <th>Price</th>
                                            <th style="width: 40px">Status</th>
                                            <th>Action</th>
                                        </tr>
                                        @if($grade_level_id < 13)
                                            @foreach ($others as $key => $data)
                                                <tr>
                                                    <td>{{$key+1}}.)</td>
                                                    <td>{{$data->transaction_id}}</td>
                                                    <td>{{$data->or_no }}</td>
                                                    <td>{{$data->other->other_fee_name}}</td>
                                                    <td>{{$data->item_qty}}</td>
                                                    <td>{{number_format($data->item_price, 2)}}</td>
                                                    <td><span class="label bg-green">Paid</span></td>
                                                    <td>
                                                        <a class="btn btn-sm btn-danger js-btn_print_other pull-right" title="print"
                                                            data-syid="{{ $data->school_year_id }}"
                                                            data-studid="{{ $data->student_id }}"
                                                            data-or_num="{{$data->or_no }}"
                                                            data-id="{{ $data->id }}"
                                                            style="margin-left: 5px"
                                                        >
                                                            <i class="fa fa-file-pdf"></i>
                                                        </a>
                                                       
                                                        <a class="btn btn-sm btn-primary btn-other-edit pull-right" title="edit" data-id="{{ $data->id }}">
                                                            <i class="far fa-edit"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <option value="">The Grade level is over and not qualified.</option>
                                        @endif
                                    </tbody>                                                
                                </table>
                                
                            </div>
                            <!-- /.box-body -->
                                        
                        @else
                        <div class="col-md-12">                            
                            <h5 style="text-align: center"><b>No payment history yet.</b></h5>                            
                        </div>
                        @endif
                    </div>
                    
                </div>

                <div class="tab-pane" id="discount-history">
                    <h3>Discount History</h3>
                    <table class="table table-bordered table-hover table-striped" style="margin-top: 20px">
                        <thead>
                            <tr>
                                <th  style="width: 15%">Transaction ID</th>
                                <th  style="width: 15%">OR Number</th>
                                <th  style="width: 13%">Discount Type</th>
                                <th  style="width: 12%">Discount Amount</th>
                                <th  style="width: 15%">Date</th>
                                <th  style="width: 15%">Action</th>
                            </tr>
                        </thead>       
                        @if($HasTransactionDiscount) 
                            @foreach ($TransactionDiscount as $item)
                                <tr>
                                    <td>{{ $item->transaction_month_paid_id }}</td>
                                    <td></td>
                                    <td>{{ $item->discount_type }}</td>
                                    <td>{{ number_format($item->discount_amt, 2) }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>
                                        <a class="btn btn-sm btn-primary btn-transaction-edit" title="edit" data-id="">
                                            <i class="far fa-edit"></i>
                                        </a>
                                        <a class="btn btn-sm btn-danger js-btn_print_transaction" title="print"
                                                data-syid=""
                                                data-studid=""
                                                data-or_num=""
                                                >
                                            <i class="fa fa-file-pdf"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>                                
                                <th colspan="5" style="text-align: center">No Discount History</td>
                            </tr>
                        @endif
                    </table>
                </div>
                

                
            </div>
        </div>
                       
    </div>
