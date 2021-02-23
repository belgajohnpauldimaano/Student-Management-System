<h5>Instructions</h5>

<div class="mt-2">
    <form id="js-instruction-form">
        {{ csrf_field() }}
        @if($instruction != null)
            <input type="hidden" name="instruction_id" value="{{ $instruction->id }}">
        @endif
        <div class="form-group">
            <div class="row">
                <div class="col-md-12">
                    {{-- <label for="summernote">Instructions</label> --}}
                    <textarea name="instruction" id="summernote">{!! ($instruction != null ? $instruction->instructions : '') !!}</textarea>
                    <div class="help-block text-red" id="js-instruction"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label>Instructions for:</label>
                <select class="form-control form-control-sm" name="instructions_type" style="width: 100%;">
                    <option value="1" {{ $instruction ? $instruction->question_type==1 ? 'selected' : '' : ''}}>Multiple Choice</option>
                    <option value="2" {{ $instruction ? $instruction->question_type==2 ? 'selected' : '' : ''}}>True/False</option>
                    <option value="3" {{ $instruction ? $instruction->question_type==3 ? 'selected' : '' : ''}}>Matching</option>
                    <option value="4" {{ $instruction ? $instruction->question_type==4 ? 'selected' : '' : ''}}>Ordering</option>
                    <option value="5" {{ $instruction ? $instruction->question_type==5 ? 'selected' : '' : ''}}>Fill in the Blank Text</option>
                    <option value="6" {{ $instruction ? $instruction->question_type==6 ? 'selected' : '' : ''}}>Short Answer/Essay</option>
                </select>
                <div class="help-block text-red" id="js-instructions_type"></div>
            </div>
            <div class="col-md-4">
                <label for="">Assessment Part Number: </label>
                <select class="form-control form-control-sm" name="part_number" style="width: 100%;">
                    @for ($x = 1; $x < 11; $x++)
                        <option value="{{ $x }}" {{ ($instruction != null ? ($instruction->order_number == $x ? 'selected' : '') : '') }}>
                            {{ $x }}
                        </option>
                    @endfor
                </select>
                <div class="help-block text-red" id="js-part_number"></div>
            </div>
        </div>
        <div class="mt-1 float-right">
            <button type="submit" id="btn-instructions-type-selected" class="btn btn-primary">
                <i class="fas fa-save"></i> Save
            </button>
        </div>
    </form>
</div>