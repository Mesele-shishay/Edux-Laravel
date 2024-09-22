<div class="col-md-6">
    <x-label :label="$description" />

    <span class="config-button float-end pe-4" >
        <span class="config-edit" id="{{ $name }}"><i class="fas fa-edit"></i></span>
    </span>

    <x-form-input name="{{ $name }}" id="config-{{ $name }}" value="{{ $value }}" disabled />
</div>