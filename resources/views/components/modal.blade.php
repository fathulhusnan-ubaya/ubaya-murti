<div class="modal fade" id="{{ $id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-{{ $size }}">
        <div class="modal-content">
            <div class="modal-header border-bottom pb-4">
                <h5 class="modal-title m-0" id="{{ $id }}-header">{!! $header !!}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="top:27px;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pt-4" id="{{ $id }}-body">
                {!! $slot !!}
            </div>
            @empty($footer) @else
                <div class="card-footer" id="{{ $id }}-footer">
                    {!! $footer !!}
                </div>
            @endempty
        </div>
    </div>
</div>