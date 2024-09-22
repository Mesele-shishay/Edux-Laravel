<div class="form-check form-switch">
  <input type="checkbox"
          class="form-check-input"
          id="{{ $id }}"
          role="switch"
          name="{{ $name }}"
          @checked($check)>
<label class="form-check-label" for="{{ $id }}">{{ $label }}</label>
</div>
