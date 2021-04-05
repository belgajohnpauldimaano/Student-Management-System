
<div class="table-responsive" style="height: 350px;">
    <div class="float-right">
        {{ $Assessment ? $Assessment->links() : '' }}
    </div>
    <table class="table table-sm table-hover">
        <thead>
            <tr>
                <th>Assessment Name</th>
                <th>Exam Period</th>
                <th>Date Publish</th>
                <th>Date Expiration</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($Assessment as $item)

                <tr>
                    {{-- {{ $item }} --}}
                    <td class="align-middle">
                        <i class="far fa-file"></i> {{ $item->title }}
                    </td>
                    <td class="align-middle" style="width: 11%">
                        {!! $item->exam_period_badge !!}
                    </td>
                    <td class="align-middle" style="width: 15%">
                        {{ $item->date_time_publish }}
                    </td>
                    <td class="align-middle" style="width: 15%">
                        {{ $item->date_time_expiration }}
                    </td>
                    <td class="align-middle" style="width: 5%">
                        {!! $item->exam_status_badge !!}
                    </td>
                    <td class="align-middle" style="width: 15%">
                        <a href="#" data-id="{{ encrypt($item->class_subject_details_id) }}" type="button" class="btn btn-sm btn-danger" id="js-button-take">
                            <i class="fas fa-edit nav-icon"></i> Take Assessment
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <th colspan="6" class="text-center">
                        No Record Found
                    </th>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>