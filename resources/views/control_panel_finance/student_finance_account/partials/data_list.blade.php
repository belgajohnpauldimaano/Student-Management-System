
                                                
<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active">
            <a href="#js-unpaid" data-toggle="tab">Not yet Paid</a>
        </li>                                
        <li>
            <a href="#js-paid" data-toggle="tab">Paid</a>
        </li>        
    </ul>
    <div class="tab-content">                                
        <div class="active tab-pane" id="js-unpaid">     
            <div class="pull-right">
                {{ $Unpaid ? $Unpaid->links() : '' }}
            </div>
            <table class="table no-margin table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Student level</th>
                        <th>Balance</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($Unpaid as $key => $data)
                        <tr>
                            <td>{{$key + 1}}.</td>
                            <td>{{$data->student_name}}</td>
                            <td>{{$data->student_level}}</td>
                            <td>
                                <?php 
                                    $bal = \App\TransactionMonthPaid::where('transaction_id', $data->transactions_id)->ORDERBY('id', 'DESC')->first();
                                    if($bal){
                                        echo number_format($bal->balance, 2);
                                    }else{
                                        echo '0.00';
                                    }                        
                                ?>
                            </td>
                            <td>
                                <span class="label label-danger">
                                   Not yet Paid
                                </span>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-primary btn-disapprove-modal" data-id="{{$data->transactions_id}}">View</button>
                                <button class="btn btn-sm btn-success btn-paid" data-id="{{$data->transactions_id}}">
                                    Paid
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>                                 

        <div class="tab-pane" id="js-paid">
            <div class="pull-right">
                {{ $Paid ? $Paid->links() : '' }}
            </div>
            <table class="table no-margin table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Student level</th>
                        <th>Balance</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($Paid as $key => $data)
                        <tr>
                            <td>{{$key + 1}}.</td>
                            <td>{{$data->student_name}}</td>
                            <td>{{$data->student_level}}</td>
                            <td>
                                <?php 
                                    $bal = \App\TransactionMonthPaid::where('transaction_id', $data->transactions_id)->ORDERBY('id', 'DESC')->first();
                                    if($bal){
                                        echo number_format($bal->balance, 2);
                                    }else{
                                        echo '0.00';
                                    }                        
                                ?>
                            </td>
                            <td>
                                <span class="label label-success">
                                    Paid
                                </span>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-primary btn-disapprove-modal" data-id="{{$data->transactions_id}}">View</button>
                                <button class="btn btn-sm btn-danger btn-unpaid" data-id="{{$data->transactions_id}}">
                                    Unpaid
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>  
    </div>                  
</div> 
