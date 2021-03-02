<div class="table-responsive">
    <h5 class="mb-3">
        Subject: <span class="text-red"><i>{{ $ClassSubjectDetail->subject->subject }}</i></span>
        {{-- <div class="text-right" style="margin-top: -1em">
            <button id="js-print" class="btn btn-primary btn-sm" 
                data-id='{{$class_detail->id}}' 
                data-sy='{{$class_detail->school_year_id}}'
                data-adviser_id='{{$class_detail->adviser_id}}'
            >
                <i class="far fa-edit"></i> Edit
            </button>
        </div>     --}}
        <a href="" class="btn-primary btn btn-sm float-right">
            <i class="fas fa-archive"></i> Archived
        </a>
    </h5>
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
                    <td class="align-middle">
                        <a class="btn btn-link" href="{{ route('faculty.assessment_subject.edit', [encrypt($item->id),'tab' => 'setup']) }}">
                            <i class="far fa-file"></i> {{ $item->title }}
                        </a>
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
                    <td class="align-middle" style="width: 11%">
                        <div class="btn-group btn-group-sm">
                            <button type="button" class="btn btn-danger"><i class="fas fa-cog"></i> Action</button>
                            <button type="button" class="btn btn-danger dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                {{-- {{ route('faculty.assessment_subject.edit', encrypt($item->id)) }} --}}
                                <a href="{{ route('faculty.assessment_subject.edit', [encrypt($item->id),'tab' => 'setup']) }}" class="dropdown-item" data-id="{{ $item->id }}">
                                    <i class="far fa-eye"></i> View
                                </a>
                                <a href="#" class="dropdown-item js-{{ $item->exam_status == 1 ? 'btn-Unpublish' : 'btn-publish' }}" data-id="{{ $item->id }}" data-type="{{ $item->exam_status == 1 ? 'unpublish' : 'publish' }}">
                                    <i class="far fa-check-square"></i> {{ $item->exam_status == 1 ? 'Mark as Unpublish' : 'Mark as  Publish' }}
                                </a>
                                <a href="#" class="dropdown-item js-btn_archived" data-id="{{ $item->id }}">
                                    <i class="fas fa-archive"></i> Move as Archive
                                </a>
                                {{-- <a href="#" class="dropdown-item js-btn_toggle_current" data-id="{{ $data->id }}" data-toggle_title="{{ ( $data->current ? 'Remove from current active' : 'Add to current active' ) }}">
                                    {{ ( $data->current ? 'Remove from current Active' : 'Add to current Active' ) }}
                                </a> --}}
                            </div>
                        </div>
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