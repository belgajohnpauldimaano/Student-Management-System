<div class="">
   <a class="btn js-modal" data-type="lesson">
     <i class="fas fa-edit fa-lg text-success"></i> Add Lesson
   </a>
   <a class="btn js-modal" data-type="assignment">
     <i class="fas fa-book fa-lg text-primary"></i> Add Assignment
   </a>
   <a class="btn js-modal" data-type="announcement">
     <i class="fas fa-bullhorn fa-lg text-danger"></i> Add Announcement
   </a>
</div>

<div class="mt-3">
    <div class="pb-3">
        <button type="button" class="close" title="close this editor">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    <div class="form-group form-group-sm w-100">
        <label>Section</label>
        <select class="select2" multiple="multiple" data-placeholder="Select a State" style="width: 100%;">
            <option>Alabama</option>
            <option>Alaska</option>
            <option>California</option>
            <option>Delaware</option>
            <option>Tennessee</option>
            <option>Texas</option>
            <option>Washington</option>
        </select>
    </div>
    <div class="form-group form-group-sm w-100">
        <label>Subject</label>
        <select class="form-control select2" style="width: 100%;">
            <option>Announcement</option>
            <option>Lesson</option>
            <option>Assessment</option>
        </select>
    </div>
    <div class="form-group form-group-sm w-100">
        <label>Category</label>
        <select class="form-control select2" style="width: 100%;">
            <option>Ungraded</option>
            <option>Performance Task</option>
            <option>Lesson</option>
            <option>Assessment</option>
        </select>
    </div>
    <div class="form-group form-group-sm w-100">
        <label>Post Status</label>
        <select class="form-control select2" style="width: 100%;">
            <option selected="selected">Published</option>
            <option>Draft</option>
            <option>Archived</option>
        </select>
    </div>
    <div class="form-group form-group-sm w-100">
        <label for="">Post Title</label>
            <input type="text" class="form-control form-control-sm" name="title" value="">
            <div class="help-block text-red text-center" id="title-error">
        </div>
    </div>
    <div class="form-group">
        <textarea id="summernote" rows="2"></textarea>
    </div>
    <div class="form-group">
        <label for="exampleInputFile">Upload File <i class="text-red"><small>Note: pptx, word and excel file can upload only</small></i></label>
        <div class="input-group">
            <div class="custom-file">
                <input type="file" class="custom-file-input form-control form-control-sm" name="payroll" id="payroll">
                <label class="custom-file-label" id="btn-upload-payroll" for="payroll">
                    {{-- @forelse ($payroll->documents as $item)
                      {{ decrypt($item->path_name)}}
                    @empty
                        Choose file
                    @endforelse --}}
                    Choose file
                </label>
            </div>
            {{-- <div class="input-group-append">
                <span class="input-group-text">Upload</span>
            </div> --}}                           
        </div>
        <div class="help-block text-red text-center" id="js-payroll"></div>        
    </div>
    <div class="form-group">
        <button type="button" class="btn btn-primary float-right">Create</button>
    </div>
</div>
