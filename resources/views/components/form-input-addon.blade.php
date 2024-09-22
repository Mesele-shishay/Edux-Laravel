@php
    $attributes = $attributes->class([
        'input-group-text',
    ])->merge([
        //
    ]);
@endphp

@if($icon || $label || !$slot->isEmpty())
    <span {{ $attributes }}>
        {{-- <x-icon :name="$icon"/> --}}

        {{ $label ?? $slot }}
    </span>
@endif
