@php
    if ($type == 'number') $inputmode = 'decimal';
    else if (in_array($type, ['tel', 'search', 'email', 'url'])) $inputmode = $type;
    else $inputmode = 'text';

    if ($debounce) $bind = 'debounce.' . (ctype_digit($debounce) ? $debounce : 150) . 'ms';
    else if ($lazy) $bind = 'lazy';
    else $bind = 'defer';

    $wireModel = $attributes->whereStartsWith('wire:model')->first();
    $key = $attributes->get('name', $model ?? $wireModel);
    $id = $attributes->get('id', $model ?? $wireModel);
    $prefix = config('laravel-bootstrap-components.use_with_model_trait') ? 'model.' : null;

    $attributes = $attributes->class([
        'form-control',
        'form-control-' . $size => $size,
        'is-invalid' => $errors->has($key),
    ])->merge([
        'type' => $type,
        'inputmode' => $inputmode,
        'id' => $id,
    ]);
    if($required) $required = 'required';

@endphp

<div class="mb-3">

    <x-label :for="$id" :label="$label"/>

    <div class="input-group">

        <x-form-input-addon :icon="$icon" :label="$prepend"/>

        <input {{ $attributes }} @isset ($required) required @endisset>

        <x-form-input-addon :label="$append" class="rounded-end"/>

        <x-error :key="$key"/>

    </div>

    <x-help :label="$help"/>
</div>
