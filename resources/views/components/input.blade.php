<div {!! $attributes->except(['label', 'id', 'prepand', 'append', 'type', 'placeholder', 'classInput', 'value', 'required', 'disabled', 'readonly']) !!}>
    @empty($label) @else
        <x-label for="{{ $id ?? '' }}" :required="$required" class="mb-1">{!! $label !!}</x-label>
    @endempty

    <div class="form-group input-group transparent mb-1">
        @empty($prepand) @else
            <div class="input-group-prepend" id="{{ !empty($id) ? "$id-prepend" : '' }}">
                <span class="input-group-text transparent">{!! $prepand !!}</span>
            </div>
        @endempty

        <input
            id="{{ $id }}"
            name="{{ $name }}"
            type="{{ in_array($type, ['date', 'time', 'datetime']) ? ($required ? 'text' : 'search') : $type }}"
            placeholder="{{ $placeholder }}"
            value="{{ old(str($name)->replace(']', '')->replace('[', '.')->toString()) ?? $value }}"
            @if ($type == 'number')
                min="{{ $min }}"
                max="{{ $max }}"
            @endif
            class="form-control {{ in_array($type, ['date', 'time', 'datetime']) ? "to-{$type}picker" : '' }} {{ $classInput }} @error(str($name)->replace(']', '')->replace('[', '.')->toString()) is-invalid @enderror"
            {{ $attributes }}
            @empty($accept) @else accept="{{ $accept }}" @endempty
            @if ($required) required @endif
            @if ($disabled) disabled @endif
            @if ($readonly) readonly @endif
        />

        @if(!empty($append) || (in_array($type, ['password', 'date', 'time', 'datetime']) && !empty($id)))
            <div class="input-group-append" id="{{ !empty($id) ? "$id-append" : '' }}" style="{{ in_array($type, ['password', 'date', 'time', 'datetime']) ? 'cursor:pointer;' : '' }}">
                <span class="input-group-text transparent">
                    @if (!empty($append))
                        {!! $append !!}
                    @elseif ($type == 'password')
                        <i class="pg-icon mb-0" for="{{ $id ?? '' }}">eye</i>
                    @elseif ($type == 'date' || $type == 'datetime')
                        <label class="pg-icon mb-0" for="{{ $id ?? '' }}" style="cursor: pointer">calendar</label>
                    @elseif ($type == 'time')
                        <label class="pg-icon mb-0" for="{{ $id ?? '' }}" style="cursor: pointer">clock</label>
                    @endif
                </span>
            </div>
        @endempty
    </div>

    @error(str($name)->replace(']', '')->replace('[', '.')->toString())
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

@push('script')
    @if ($type === 'password' && !empty($id))
        <script>
            console.log('test')
            $("#{{ $id }}-append").click(function() {
                var i = $(this).find('i').eq(0)
                if (i.html() == 'eye') {
                    $("#{{ $id }}").attr('type', 'text');
                    i.html("eye_off")
                } else {
                    $("#{{ $id }}").attr('type', 'password');
                    i.html("eye")
                }
            })
        </script>
    @elseif (in_array($type, ['date', 'time', 'datetime']))
        @once
            @if ($type == 'date')
                <script>
                    $(document).ready(function() {
                        $(".to-datepicker").mask("99/99/9999")
                        $(".to-datepicker").datepicker({ format: "dd/mm/yyyy" })
                    })
                </script>
            @elseif ($type == 'time')
                <script>
                    $(document).ready(function() {
                        $(".to-timepicker").mask("99:99:99")
                    })
                </script>
            @elseif ($type == 'datetime')
                <!-- Flatpickr CSS -->
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
                <!-- Flatpickr JS -->
                <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
                <script>
                    $(document).ready(function() {
                        $(".to-datetimepicker").flatpickr({
                            locale: "id",
                            enableTime: true,
                            dateFormat: "d/m/Y H:i",
                            time_24hr: true,
                        })
                    })
                </script>
            @endif
        @endonce
    @endif
@endpush

