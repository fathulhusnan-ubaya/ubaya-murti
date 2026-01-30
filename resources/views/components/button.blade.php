@php
    if (!empty($href)) $type = 'a';
    if ($type == 'submit') {
        $buttonType = 'submit';
        $type = 'button';
    };
@endphp

<{{ $type }} @if($type != 'a') type="{{ $buttonType ?? $type }}" @endif {{ !empty($href) ? "href=$href" : '' }} {!! $attributes->merge(['class' => "btn btn-$size btn-$color"])
                                                                                                                            ->except(['type', 'href', 'color', 'iconType', 'icon']) !!}>
    @empty($icon) @else
        @if ($iconType == 'pg')
            <i class="pg-icon mr-2">{{ $icon }}</i>
        @else
            <i class="{{ $iconType }} {{ $icon }} mr-2"></i>
        @endif
    @endempty
    {!! $slot !!}
</{{ $type }}>
