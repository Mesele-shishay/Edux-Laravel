@php
    $attributes = $attributes->class([
        //
    ])->merge([
        //
    ]);

@endphp

<div class="col-md-6">
    <x-label :label="$description" />

    <span class="config-button float-end pe-4">
        <span class="config-edit" id="{{ $name }}" ><i class="fas fa-edit"></i></span>
    </span>

    <x-form-select disabled {{ $attributes }} id="config-{{ $name }}" name="{{ $name }}">
        @foreach ($timezones as $timezone)
            <option value="{{ $timezone['zone'] }}" @selected($timezone['zone'] == 'value') >{{ $timezone['zone'] }}</option>
        @endforeach
    </x-form-select>
</div>