
@php
    $attributes = $attributes->class([
        'form-label',
    ])->merge([
        //
    ]);
@endphp

@if($label)
    <label {{ $attributes }} >
        {{ $label}}
        @isset ($required)
            : <sup><i class="fas fa-asterisk text-primary"></i></sup>
        @endisset
    </label>
@endif


