@php
    if ($lazy) $bind = 'lazy';
    else $bind = 'defer';

    $wireModel = $attributes->whereStartsWith('wire:model')->first();
    $key = $attributes->get('name', $model ?? $wireModel);
    $id = $attributes->get('id', $model ?? $wireModel);
    $prefix = config('laravel-bootstrap-components.use_with_model_trait') ? 'model.' : null;

    $attributes = $attributes->class([
        'form-control',
        'form-select',
        'form-select-' . $size => $size,
        'rounded-end' => !$append,
        'is-invalid' => $errors->has($key),
    ])->merge([
        'id' => $id,
        'wire:model.' . $bind => $model ? $prefix . $model : null,
    ]);
@endphp

<div class="mb-3">

    <x-label :for="$id" :label="$label"/>


    <div class="input-group">

        <select {{ $attributes }} @isset ($required) required @endisset>
            {{ $slot }}
        </select>

        <x-error :key="$key"/>

    </div>

    {{-- <x-help :label="$help"/> --}}
</div>
