<table {!! $attributes->merge(['class' => 'table table-bordered table-striped w-100']) !!}>
    <thead class="text-center font-weight-bold {{ $theadClass }}">
        {!! $thead !!}
    </thead>
    <tbody class="{{ $tbodyClass }}">
        {!! $slot !!}
    </tbody>
    @empty($tfoot) @else
        <tfoot class="{{ $tfootClass }}">
            {!! $tfoot !!}
        </tfoot>
    @endempty
</table>
