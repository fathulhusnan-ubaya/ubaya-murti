@php($value = (old(Str::replace('[]', '', $name)) ?? $value ?? ''))

<div {!! $attributes->except(['label', 'id', 'prepand', 'append', 'placeholder', 'classInput', 'options', 'value', 'required', 'disabled', 'readonly', 'route']) !!}>
    @empty($label) @else
        <x-label for="{{ $id ?? '' }}" :required="$required" class="mb-1">{!! $label !!}</x-label>
    @endempty

    <div class="form-group input-group transparent mb-1">
        @empty($prepand) @else
            <div class="input-group-prepend" id="{{ !empty($id) ? "$id-prepand" : '' }}">
                <span class="input-group-text transparent">{!! $prepand !!}</span>
            </div>
        @endempty

        <select
            name="{{ $name }}"
            id="{{ $id }}"
            style="width: 100%;"
            class="form-control select2 w-100 {{ $classInput }} @error($name) is-invalid @enderror"
            data-placeholder="{{ $placeholder }}"
            @if ($required)
                required
            @else
                data-allow-clear="true"
            @endif
            @if ($disabled) disabled @endif
            @if ($readonly) readonly @endif
            @if ($multiple) multiple @endif
        >
            <option></option>
            @foreach ($options as $key => $option)
                <option value="{{ $key ?? $option }}" @selected(is_array($value) ? in_array(($key ?? $option), $value) : ($value == ($key ?? $option)))>{{ $option }}</option>
            @endforeach
        </select>

        @empty($append) @else
            <div class="input-group-append" id="{{ !empty($key) ? "$key-append" : '' }}">
                <span class="input-group-text transparent">{!! $append !!}</span>
            </div>
        @endempty
    </div>

    @error(Str::replace('[]', '', $name))
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

@pushOnce('scripts')
    <script>
        $(document).ready(function() {
            $('.select2').select2()
        })
    </script>
@endPushOnce

@if (empty($options) && !empty($route))
    @push('scripts')
        <script>
            $(document).ready(function() {
                select2Init({
                    selector: "#{{ $id }}",
                    url: "{{ route($route) }}",
                })

                @empty ($value) @else
                    @if ($multiple)
                        @foreach($value as $selected)
                            ajaxGetRequest({
                                url: "{{ route($route.'.select') }}?search={{ $selected }}",
                                successCallback: function (result) {
                                    const option = new Option(result.text, result.id, true, true)
                                    $("#{{ $id }}").append(option).trigger('change')
                                },
                                withToast: false
                            })
                        @endforeach
                    @else
                        ajaxGetRequest({
                            url: "{{ route($route.'.select', ['search' => $value]) }}",
                            successCallback: function (result) {
                                const option = new Option(result.text, result.id, true, true)
                                $("#{{ $id }}").append(option).trigger('change')
                            },
                            withToast: false
                        })
                    @endif
                @endempty
            })
        </script>
    @endpush
@endif
