 <div class="col-md-6 form-group{% if has_error(name) %} has-error{% endif %}">
        <label for="{{ $name }}">
            {{Str::ucfirst($description)}}
        </label>
        <span class="config-button" data-default="{{ $value }}" data-name="{{ $name }}">
            <span class="config-edit"><i class="fas fa-edit"></i></span>
        </span>

        <select name="{{ $name }}" id="{{ $name }}" class="form-control mt-3" required disabled >
            <option value="1" @selected($value) >True</option>
            <option value="0" @selected(!$value)>False</option>
        </select>
        <x-config.error :name="$name"/>
    </div>