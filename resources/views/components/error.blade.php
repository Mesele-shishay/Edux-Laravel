@php
    $attributes = $attributes->class([
        'invalid-feedback',
    ])->merge([
        //
    ]);
@endphp

@error($name)
    <div {{ $attributes }}>
        {{ $message }}
    </div>
@enderror
