<form id="js-registration_button">
    {{ csrf_field() }}
    <div class="form-group">
        <div class="radio">
            <label>
                <input type="radio" name="registration_button" {{ $Registration->is_enabled == 1 ? 'checked' : '' }} value="enable">
                Show Registration button in website
            </label>
        </div>
        <div class="radio">
            <label>
                <input type="radio" name="registration_button" {{ $Registration->is_enabled == 0 ? 'checked' : '' }} value="disable">
                Hide Registration button in website
            </label>
        </div>
    </div>
    <button type="submit" class="btn btn-primary btn-flat">Update</button>
</form>
