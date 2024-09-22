@php
    $attributes = $attributes->class([
        'form-control'
    ])->merge([
        //
    ]);
@endphp
<div class="mt-3">
    @if ($label)
        <p class="mt-2">{{ $label }} : <sup><i class="fas fa-asterisk text-primary"></i></sup></p>
    @endif
    <textarea {{ $attributes }}
            id="{{ $id }}"
            name="{{ $name }}"></textarea>
</div>