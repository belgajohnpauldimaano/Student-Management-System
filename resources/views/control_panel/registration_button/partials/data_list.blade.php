<form id="js-registration_button">
    {{ csrf_field() }}
    <div class="form-group">
        <input type="checkbox" class="registration_button" name="registration_button" 
            {{ $Registration->is_enabled == 1 ? 'checked' : '' }} 
            data-bootstrap-switch
        >
    </div>
    <button type="submit" class="btn btn-primary float-right">Update</button>
</form>
