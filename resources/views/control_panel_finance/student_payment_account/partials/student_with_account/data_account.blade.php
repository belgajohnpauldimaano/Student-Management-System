
    @include('control_panel_finance.student_payment_account.partials.student_with_account.data_status')
    
    <div style="margin-botton: 100px">
        <button type="button" class="pull-right btn btn-flat btn-primary btn-md" data-id="{{ $StudentInformation->id }}" id="js-button-payment">
            <i class="fas fa-money-bill-alt"></i> Payment
        </button>
            
        <div class="nav-tabs-custom"  style="box-shadow: 0 1px 1px 1px rgba(0,0,1,0.2); margin-top: 20px">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#history" data-toggle="tab">History</a>
                </li>
                <li>
                    <a href="#others-history" data-toggle="tab">Others</a>
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
                                @foreach ($TransactionOthers = App\TransactionOtherFee::where('or_no', $item->or_no)->orderBY('id', 'DESC')->distinct()->get(['or_no']) as $key => $data)
                                    <div class="col-md-12">
                                        <div class="box" style="box-shadow: 0 .5px .5px .5px rgba(0,0,1,0.2);">
                                            <div class="box-header col-md-6">
                                                <h3 class="box-title">
                                                    OR Number: <b>{{ $item->or_no }}</b>
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
                                                            <th>Description</th>
                                                            <th>Qty</th>
                                                            <th>Price</th>
                                                            <th style="width: 40px">Status</th>
                                                        </tr>
                                                        @if($grade_level_id < 13)
                                                            {{-- @foreach ($TransactionOthers = App\TransactionOtherFee::where('or_no', $item->or_no)->orderBY('id', 'DESC')->distinct()->get() as $key => $data)
                                                                <tr>
                                                                    <td>{{$key+1}}.)</td>
                                                                    <td>{{$data->other->other_fee_name}}</td>
                                                                    <td>{{$data->others_fee_qty}}</td>
                                                                    <td>{{number_format($data->others_fee_price, 2)}}</td>
                                                                    <td><span class="label bg-green">Paid</span></td>
                                                                </tr>
                                                            @endforeach --}}
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

                

                
            </div>
        </div>
                       
    </div>
