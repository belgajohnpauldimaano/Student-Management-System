<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">ADD {{ strtoupper($type) }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group w-100">
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
                <div class="form-group w-100">
                    <label>Subject</label>
                    <select class="form-control select2" style="width: 100%;">
                        <option>Announcement</option>
                        <option>Lesson</option>
                        <option>Assessment</option>
                    </select>
                </div>
                <div class="form-group w-100">
                    <label>Post Status</label>
                    <select class="form-control select2" style="width: 100%;">
                        <option selected="selected">Published</option>
                        <option>Draft</option>
                        <option>Archived</option>
                    </select>
                </div>
                <div class="form-group w-100">
                    <label for="">Post Title</label>
                        <input type="text" class="form-control" name="title" value="">
                        <div class="help-block text-red text-center" id="title-error">
                    </div>
                </div>
                <textarea id="summernote" rows="2"></textarea>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>