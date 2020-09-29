
    @include('control_panel_finance.student_payment_account.partials.student_with_account.data_status')
    
    <div style="margin-botton: 100px">
        <button type="button" class="pull-right btn btn-flat btn-primary btn-md" data-id="{{ $StudentInformation->id }}" id="js-button-payment">
            <i class="fas fa-plus"></i> Add Payment
        </button>
            
        <div class="nav-tabs-custom" id="transaction-history"  style="; margin-top: 20px">
            <ul class="nav nav-tabs transaction-history">
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
                                <table class="table table-striped table-bordered">
                                    <tbody>
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Transaction ID</th>
                                            <th>OR No.</th>
                                            <th>Description</th>
                                            <th>Qty</th>
                                            <th>Price</th>
                                            <th style="width: 40px">Status</th>
                                            <th style="width:15%">Action</th>
                                        </tr>
                                        @if($grade_level_id < 13)
                                            
                                            @forelse ($others as $key => $data)
                                                <tr>
                                                    <td>{{$key+1}}.)</td>
                                                    <td>{{$data->transaction_id}}</td>
                                                    <td>{{$data->or_no }}</td>
                                                    <td>{{$data->other->other_fee_name}}</td>
                                                    <td>{{$data->item_qty}}</td>
                                                    <td>{{number_format($data->item_price, 2)}}</td>
                                                    <td><span class="label bg-green">Paid</span></td>
                                                    <td>
                                                        <a class="btn btn-sm btn-primary btn-other-edit " title="edit" data-id="{{ $data->id }}">
                                                            <i class="far fa-edit"></i>
                                                        </a>

                                                        <a class="btn btn-sm btn-success js-btn_print_other " title="print"
                                                            data-syid="{{ $data->school_year_id }}"
                                                            data-studid="{{ $data->student_id }}"
                                                            data-or_num="{{$data->or_no }}"
                                                            data-id="{{ $data->id }}"
                                                        >
                                                            <i class="fa fa-file-pdf"></i>
                                                        </a>

                                                        <a class="btn btn-sm btn-danger btn-delete " title="delete" data-id="{{ $data->id }}"  data-category="other">
                                                            <i class="far fa-trash-alt"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>                                
                                                    <th colspan="8" style="text-align: center">No Payment History</td>
                                                </tr>
                                            @endforelse
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
                    <h3>Discount/Subsidy History</h3>
                    <table class="table table-bordered table-hover table-striped" style="margin-top: 20px">
                        <thead>
                            <tr>
                                <th  style="width: 15%">Transaction ID</th>
                                <th  style="width: 15%">OR Number</th>
                                <th  style="width: 15%">Name</th>
                                <th  style="width: 13%">Type</th>
                                <th  style="width: 12%">Amount</th>
                                <th  style="width: 15%">Date</th>
                                <th  style="width: 10%">Action</th>
                            </tr>
                        </thead>       
                        
                            @forelse ($TransactionDiscount as $item)
                                <tr>
                                    <td>{{ $item->transaction_month_paid_id }}</td>
                                    <td>{{ $item->transactionMonth->or_no }}</td>
                                    <td>{{ $item->discount_type }}</td>
                                    <td>{{ $item->category == 0 ? 'Subsidy' : 'Discount' }}</td>
                                    <td>{{ number_format($item->discount_amt, 2) }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>
                                        <a class="btn btn-sm btn-primary btn-discount-edit" title="edit" data-id="{{ $item->id }}">
                                            <i class="far fa-edit"></i>
                                        </a>
                                        
                                        <a class="btn btn-sm btn-danger btn-delete " title="delete" data-id="{{ $item->id }}" data-category="discount">
                                            <i class="far fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>                                
                                    <th colspan="7" style="text-align: center">No Discount History</td>
                                </tr>
                            @endforelse 
                    </table>
                </div>
                
            </div>
        </div>
                       
    </div>