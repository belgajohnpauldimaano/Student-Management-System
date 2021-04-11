{{-- <div class="float-right" style="margin-top: -.5em">
    @if($Assessment != null)
        <a href="{{ route('faculty.question', [encrypt($Assessment->id), 'tab' => 'questions'] ) }}" class="btn btn-info">
            <i class="far fa-eye fa-lg"></i> Preview
        </a>
    @endif
</div> --}}
<h5>Student Assessment Monitoring</h5>

<div class="mt-4">
    <form id="js-instruction-form">
        {{ csrf_field() }}
        @if($instruction != null)
            <input type="hidden" name="instruction_id" value="{{ $instruction->id }}">
        @endif
        @if($Assessment != null)
            <input type="hidden" name="assessment_id" value="{{ $Assessment->id }}">
        @endif

        <div class="row">
            <div class="table-responsive table-responsive-sm" style="height: 350px;">
            <table id="table-monitoring" class="table table-sm table-hover table-head-fixed table-condensed">
                <thead>
                    <th>No.</th>
                    <th>Student Name</th>
                    <th>Score</th>
                    <th>Start Time</th>
                    <th>Status</th>
                    <th class="text-center">Action</th>
                </thead>
                <tbody></tbody>
            </table>
            </div>
        </div>
        {{-- <div class="mt-1 float-right">
            <button type="submit" id="btn-instructions-type-selected" class="btn btn-primary">
                <i class="fas fa-save"></i> Save
            </button>
        </div> --}}
    </form>
</div>