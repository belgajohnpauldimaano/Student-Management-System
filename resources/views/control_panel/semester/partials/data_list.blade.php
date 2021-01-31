<table class="table table-sm table-hover no-margin">
    <thead>
        <tr>
            <th>Semester</th>
            <th>Set</th>
            {{-- <th>Status</th> --}}
            <th class="text-center">Actions</th>
        </tr>
    </thead>
    <tbody>
        @if ($Semester)
            @foreach ($Semester as $data)
                <tr>
                    <td>{{ $data->semester }}</td>
                    <td>
                        <span class="badge badge-{{ $data->current == 1 ? 'success' : 'danger' }}">
                            {{ $data->current == 1 ? 'Yes' : 'No' }}
                        </span>
                    </td>
                    <td class="text-center">
                        <a href="#" class="btn btn-sm btn-{{ ( $data->current ? 'danger' : 'success' ) }} 
                            js-btn_toggle_current" 
                            data-id="{{ $data->id }}" 
                            data-toggle_title="{{ $data->current ? 'De-activate' : 'Activate' }}"
                        >
                            <i class="fas fa-{{ $data->current ? 'times' : 'check' }}"></i>
                            {{ $data->current ? 'De-Activate' : 'Activate' }}
                        </a>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>