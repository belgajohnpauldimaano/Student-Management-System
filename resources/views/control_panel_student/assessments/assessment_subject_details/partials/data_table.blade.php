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
        {!! $item->assessment_button !!}
    </td>
</tr>