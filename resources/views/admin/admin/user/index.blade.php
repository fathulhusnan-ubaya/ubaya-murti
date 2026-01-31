@extends('layouts.admin', [
    'judul' => 'User',
    'breadcrumbs' => [
        [
            'url' => '#',
            'title' => "Administrator",
        ]
    ]
])

@section('contents')
    <x-button icon="fa-plus" size="lg" href="{{ route('admin.user.create') }}" class="mb-3">Tambah</x-button>

    <x-card header="Daftar User">
        <x-table id="table">
            <x-slot name="thead">
                <tr>
                    <td width="50px">No.</td>
                    <td width="200px">Username</td>
                    <td>Nama</td>
                    <td>Email</td>
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
                url: "{{ route('admin.user.index') }}",
                columns: [
                    { data: "Username" },
                    { data: "Nama"},
                    { data: "Email" },
                ],
                withAction: true,
            })
        })

        $(document).on('click', '.btn-delete', function() {
            const id = $(this).data('id')
            const nama = $(this).data('nama')
            NegativeConfirm.fire({
                title: 'Yakin ingin menghapus user ' + nama + '?',
            }).then((result) => {
                if (result.isConfirmed) {
                    loading()
                    $("#form-delete").attr('action', "{{ route('admin.user.destroy', ['-id-']) }}".replace('-id-', id)).submit()
                }
            })
        })
    </script>
@endpush
