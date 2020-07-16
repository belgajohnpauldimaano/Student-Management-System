                                                
<div class="table-responsive">                  
    <div class="pull-right">
        {{ $Disapproved ? $Disapproved->links() : '' }}
    </div>
    <table class="table no-margin table-bordered table-striped">
        <thead>
            <tr>
                <th>No.</th>
                <th width="17%">Name</th>
                <th>Student level</th>
                <th>Tuition Fee</th>
                <th>Misc Fee</th>
                <th>Other Fee</th>
                <th>Disc Fee</th>
                <th>Total Fees</th>
                <th>Payment</th>
                <th>Balance</th>
                <th>Status</th>
                <th width="10%">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($Disapproved as $key => $data)
                <tr>
                    <td>{{$key + 1}}</td>
                    <td>{{$data->student_name}}</td>
                    <td>{{$data->student_level}}</td>
                    <td>{{number_format($data->tuition_amt,2)}}</td>
                    <td>{{number_format($data->misc_amt,2)}}</td>
                    <td>
                        <?php 
                            $other = \App\TransactionOtherFee::where('student_id', $data->student_id)
                                ->where('school_year_id', $data->school_year_id)
                                ->where('transaction_id', $data->transaction_id)
                                ->where('isSuccess', 1)
                                ->sum('item_price');
                            echo number_format($other, 2);
                        ?>
                    </td>
                    <td>
                        <?php 
                            $discount = \App\TransactionDiscount::where('student_id', $data->student_id)
                                ->where('school_year_id', $data->school_year_id)
                                ->where('isSuccess', 1)
                                ->sum('discount_amt');
                            echo number_format($discount, 2);
                        ?>
                    </td>
                    <td>
                        {{number_format(($data->tuition_amt + $data->misc_amt + $other) - $discount, 2)}}
                    </td>
                    <td>{{number_format($data->payment,2)}}</td>
                    <?php 
                        $payment = \App\TransactionMonthPaid::where('student_id', $data->student_id)
                            ->where('school_year_id', $data->school_year_id)
                            ->where('isSuccess', 1)
                            ->where('approval', 'Approved')
                            ->sum('payment');

                        $incoming_bal = (($data->tuition_amt + $data->misc_amt + $other) - $discount) - $payment - $data->payment;
                    ?>
                    <td>{{number_format($incoming_bal,2)}}</td>
                    <td>
                        <span class="label label-danger">
                            Disapproved
                        </span>
                    </td>
                    <td>
                        <a class="btn btn-sm btn-primary btn-view-modal" title="View" data-id="{{$data->transaction_id}}"  data-monthly_id="{{$data->transact_monthly_id}}"><i class="fas fa-eye"></i></a>
                        <a class="btn btn-sm btn-success btn-approve" title="Approve" data-id="{{$data->transact_monthly_id}}"><i class="fas fa-thumbs-up"></i></a>
                        
                        {{-- <div class="input-group-btn pull-left text-left">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Action
                                <span class="fa fa-caret-down"></span></button>
                            <ul class="dropdown-menu">
                                <li><a href="#" class="btn-view-modal" data-id="{{$data->transaction_id}}"  data-monthly_id="{{$data->transact_monthly_id}}">View</a></li>
                                <li><a href="#" class="btn-approve" data-id="{{$data->transact_monthly_id}}">Approve</a></li>
                                <li><a href="#" class="btn-disapprove"  data-id="{{$data->transact_monthly_id}}">Disapprove</a></li>
                            </ul>
                        </div>  --}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
                                
                        