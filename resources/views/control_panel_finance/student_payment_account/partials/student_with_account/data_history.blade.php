<div class="col-12">       
    <h3>Payment History</h3>
    
    <div style="margin-bottom: 10px">
        <a class="btn btn-sm btn-success  btn-flat js-btn_print_all_transaction" title="print"
            data-id="{{ $Transaction->id }}">
            <i class="fa fa-file-pdf"></i> Print all transaction
        </a>
    </div>
    
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th style="width: 10%">Transaction ID</th>
                    <th style="width: 10%">Payment Option</th>
                    <th style="width: 15%">OR Number</th>
                    <th style="width: 15%">Payment Fee</th>
                    <th style="width: 10%">Balance</th>
                    <th style="width: 10%">Remarks</th>
                    <th style="width: 15%">Date</th>
                    <th style="width: 25%">Action</th>
                </tr>
            </thead>
            @if($Account)
                @forelse ($TransactionMonthPaid as $key => $item)
                    <tr>
                        <td>{{ $item->transaction_id }}</td>
                        <td>{{ $item->payment_option }}</td>
                        <td>{{ $item->or_no }}</td>
                        <td>{{ number_format($item->payment, 2)}}</td>
                        <td>{{ number_format($item->balance, 2) }}</td>
                        <td>
                            <span class="label label-{{ $item->approval == "Approved" ? 'success' : 'danger' }}">{{$item->approval}}</span>
                        </td>
                        <td>{{ date_format(date_create($item->created_at), 'F d, Y') }}</td>
                        <td>
                            <a class="btn btn-sm btn-primary btn-transaction-edit" title="edit" data-id="{{ $item->id }}">
                                <i class="far fa-edit"></i>
                            </a>
                            
                            <a class="btn btn-sm btn-success js-btn_print_transaction" title="print"
                                data-syid="{{$item->school_year_id}}"
                                data-studid="{{ $item->student_id }}"
                                data-or_num="{{ $item->or_no }}
                            ">
                                <i class="fa fa-file-pdf"></i>
                            </a>
                            
                            <a class="btn btn-sm btn-danger btn-delete_transaction" title="delete" data-id="{{ $item->id }}">
                                <i class="far fa-trash-alt"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <th colspan="9" style="text-align: center">No payment history yet.</th>
                @endforelse
            @else
                <th colspan="9" style="text-align: center">No payment history yet.</th>
            @endif
        </table>  
    </div> 
</div>   