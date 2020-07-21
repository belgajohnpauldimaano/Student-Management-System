
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
                            @foreach ($TransactionOR  as $item)
                                @foreach ($others as $key => $data)
                                    <div class="col-md-12">
                                        <div class="table table-bordered">
                                            <div class="box-header col-md-6">
                                                <h3 class="box-title">
                                                    Transaction id: <b>{{ $data->transaction_id }}</b>
                                                </h3>
                                                <br>
                                                <p>{{ date_format(date_create($item->created_at), 'F d, Y H:i:s') }}</p>
                                                
                                            </div>
                                            <div class="col-md-6">
                                                <button style="margin-top: 5px" type="button" class="btn btn-danger btn-flat js-btn_print pull-right" data-or="{{ $item->or_no }}">
                                                    <i class="fa fa-file-pdf"></i> Print
                                                </button>
                                            </div>
                                            <!-- /.box-header -->
                                            <div class="box-body no-padding">
                                                <table class="table table-striped">
                                                    <tbody>
                                                        <tr>
                                                            <th style="width: 10px">#</th>
                                                            <th>Transaction ID</th>
                                                            <th>Description</th>
                                                            <th>Qty</th>
                                                            <th>Price</th>
                                                            <th style="width: 40px">Status</th>
                                                        </tr>
                                                        @if($grade_level_id < 13)
                                                            @foreach ($others as $key => $data)
                                                                <tr>
                                                                    <td>{{$key+1}}.)</td>
                                                                    <td>{{ $data->id }}</td>
                                                                    <td>{{$data->other->other_fee_name}}</td>
                                                                    <td>{{$data->others_fee_qty}}</td>
                                                                    <td>{{number_format($data->others_fee_price, 2)}}</td>
                                                                    <td><span class="label bg-green">Paid</span></td>
                                                                </tr>
                                                            @endforeach
                                                        @else
                                                            <option value="">The Grade level is over and not qualified.</option>
                                                        @endif
                                                    </tbody>                                                
                                                </table>
                                                
                                            </div>
                                            <!-- /.box-body -->
                                        </div>
                                    </div>
                                @endforeach                          
                            @endforeach
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
                                <th  style="width: 15%">Discount Type</th>
                                <th  style="width: 15%">Discount Amount</th>
                                <th  style="width: 15%">Date</th>
                            </tr>
                        </thead>        
                        @foreach ($TransactionDiscount as $item)
                            <tr>
                                <td>{{ $item->transaction_month_paid_id }}</td>
                                <td></td>
                                <td>{{ $item->discount_type }}</td>
                                <td>{{ number_format($item->discount_amt, 2) }}</td>
                                <td>{{ $item->created_at }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                

                
            </div>
        </div>
                       
    </div>
