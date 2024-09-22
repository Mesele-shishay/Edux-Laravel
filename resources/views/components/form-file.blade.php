@php
    $attributes = $attributes->class([
        //
    ])->merge([
        //
    ]);
    // $key = $attributes->get('name', $model ?? '');

@endphp

<div class="mb-3">
    <label for="{{ $id }}">{{ $label }}</label>: @isset ($required) <sup><i class="fas fa-asterisk text-primary"></i></sup> @endisset
        <input type="file"
                class="form-control @error($name) is-invalid @enderror"
                name="{{ $name }}"
                id="{{ $id }}"
                @isset ($required) required @endisset>
        <x-error key="$name"/>
</div>
