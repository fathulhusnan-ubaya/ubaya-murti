@props(['sendingFile' => false])

<form action="{{ $action }}" method="{{ $method != 'GET' ? 'POST' : 'GET' }}"  @if($sendingFile) enctype="multipart/form-data" @endif {!! $attributes->except(['action', 'method']) !!}>
    @if ($method != 'GET')
        @csrf
        @method($method)
    @endif

    <input type="hidden" name="_action" value="{{ $action }}">

    {!! $slot !!}

    @empty($submit) @else
        <div class="text-right">
            <x-button class="btn-lg @if($submitBlock) btn-block w-100 @endif" type="submit" iconType="{{ $submitIconType }}" icon="{{ $submitIcon }}">{{ $submit }}</x-button>
        </div>
    @endempty
</form>
