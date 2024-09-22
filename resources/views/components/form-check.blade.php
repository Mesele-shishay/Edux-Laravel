<div class="mb-3">
    <div class="form-check">
        <input type="checkbox"
                class="form-check-input"
                id="{{ $id }}"
                name="{{ $name }}"
                @checked($checked) >
        <label class="form-check-label" for="{{ $id }}">{{ $label }}</label>
    </div>
</div>