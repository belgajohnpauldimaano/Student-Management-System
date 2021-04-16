<tr>
    <td class="align-middle">
        <i class="far fa-file"></i> {{ $item->title }}
    </td>
    <td class="align-middle text-center" style="width: 11%">
        {!! $item->exam_period_badge !!}
    </td>
    <td class="align-middle text-center" style="width: 15%">
        {{ $item->date_time_publish }}
    </td>
    <td class="align-middle text-center" style="width: 15%">
        {{ $item->date_time_expiration }}
    </td>
    <td class="align-middle text-center" style="width: 5%">
        {!! $item->exam_status_badge !!}
    </td>
    <td class="align-middle text-center" style="width: 15%">
        @if($item->status != 3)
            <a href="#" data-id="{{ encrypt($item->assessment_id) }}" 
                type="button" class="btn btn-sm btn-danger" id="js-button-take">
                <i class="fas fa-edit nav-icon"></i> Take Assessment
            </a>
        @else
            <a href="#" data-id="{{ encrypt($item->assessment_id) }}" 
                type="button" class="btn btn-sm btn-primary" id="js-button-take">
                <i class="fas fa-eye nav-icon"></i> View
            </a>
        @endif
    </td>
</tr>