@extends('layouts.admin', [
    'judul' => 'Menu',
    'breadcrumbs' => [
        [
            'url' => '#',
            'title' => "Administrator",
        ]
    ]
])

@section('contents')
    <x-button icon="fa-plus" size="lg" href="{{ route('admin.menu.create') }}" class="mb-3">Tambah</x-button>

    <x-card header="Daftar Menu">
        <x-table id="table">
            <x-slot name="thead">
                <tr>
                    <td width="50px">No.</td>
                    <td width="200px">Judul</td>
                    <td>Aktif</td>
                    <td>Menu Induk</td>
                    <td width="350px">Aksi</td>
                </tr>
            </x-slot>
        </x-table>
    </x-card>

    <x-form id="form-delete" method="DELETE" action=""></x-form>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            datatablesInit({
                selector: "#table",
                url: "{{ route('admin.menu.index') }}",
                columns: [
                    { data: "Judul" },
                    { data: "IsAktif", className: 'text-center' },
                    { data: "MenuInduk", orderable: false },
                ],
                withAction: true,
            })
        })

        $(document).on('click', '.btn-delete', function() {
            const id = $(this).data('id')
            const nama = $(this).data('nama')
            NegativeConfirm.fire({
                title: 'Yakin ingin menghapus menu ' + nama + '?',
            }).then((result) => {
                if (result.isConfirmed) {
                    loading()
                    $("#form-delete").attr('action', "{{ route('admin.menu.destroy', ['-id-']) }}".replace('-id-', id)).submit()
                }
            })
        })
    </script>
@endpush
