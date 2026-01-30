<label {{ !empty($for) ? "for=$for" : '' }} {!! $attributes->except(['for']) !!}>
    {!! $slot !!} @if($required)<i style="color: red;">*</i>@endif
</label>
