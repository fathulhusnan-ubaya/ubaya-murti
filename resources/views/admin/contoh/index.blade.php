@extends('layouts.admin', [
    'judul' => 'Contoh'
])

@section('contents')
    <x-button icon="fa-plus" size="lg" href="{{ route('contoh.create') }}" class="mb-3">Tambah</x-button>

    <x-card header="Daftar Contoh">
        <x-table id="table">
            <x-slot name="thead">
                <tr>
                    <td width="50px">No.</td>
                    <td>Nama</td>
                    <td width="350px">Aksi</td>
                </tr>
            </x-slot>
        </x-table>
    </x-card>

    <x-form id="form-delete" method="DELETE" action=""></x-form>
@endsection

@push('scripts')
    <script>
        $(function () {
            $('#contoh-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('contoh.index') }}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'Nama', name: 'Nama' },
                    { data: 'Aksi', name: 'Aksi', orderable: false, searchable: false },
                ],
            });
        });
    </script>
@endpush
