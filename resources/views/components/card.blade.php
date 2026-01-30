<div {!! $attributes->merge(['class' => 'card']) !!}>
    @empty($header) @else
        <div class="card-header border-bottom">
            <div class="card-title font-weight-bold" @empty($attributes['id']) @else id="{{ $attributes['id'] }}-header" @endif>{!! $header !!}</div>
        </div>
    @endempty
    <div class="card-body pt-3" @empty($attributes['id']) @else id="{{ $attributes['id'] }}-body" @endif>
        {!! $slot !!}
    </div>
    @empty($footer) @else
        <div class="card-footer py-3" @empty($attributes['id']) @else id="{{ $attributes['id'] }}-footer" @endif>
            {!! $footer !!}
        </div>
    @endempty
</div>
