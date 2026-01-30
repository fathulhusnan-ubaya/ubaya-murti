<div {!! $attributes->merge(['class' => "form-check $color " . ($type == 'switch' ? 'switch ' : '') . ($inline ? 'form-check-inline' : '')])
    ->except(['color', 'inline', 'label', 'id', 'type', 'classInput', 'value', 'required', 'disabled', 'readonly', 'checked']) !!}>

    <input type="{{ $type == 'switch' ? 'checkbox' : $type }}"
        id="{{ $id ?? '' }}"
        name="{{ $name }}"
        class="{{ $classInput }}"
        value="{{ $value }}"
        @if ($required) required @endif
        @if ($disabled) disabled @endif
        @if ($readonly) readonly @endif
        @if ($checked) checked @endif
    />

    <x-label for="{{ $id ?? '' }}">{{ $label }}</x-label>
</div>
