@extends('layouts.admin', [
    'judul' => 'Role',
    'breadcrumbs' => [
        [
            'url' => '#',
            'title' => "Administrator",
        ]
    ]
])

@section('contents')
    <div class="row">
        <div class="col-md-8">
            <x-card header="Daftar Role">
                <x-table id="table">
                    <x-slot name="thead">
                        <tr>
                            <td width="50px">No.</td>
                            <td>Nama Role</td>
                            <td width="220px">Aksi</td>
                        </tr>
                    </x-slot>
                </x-table>
            </x-card>
        </div>
        <div class="col-md-4">
            <x-card :header="empty(old('mode')) ? 'Tambah Role' : (str(old('mode'))->title() . ' Role')" id="crud">
                <x-form :method="empty(old('mode')) || old('mode') == 'tambah' ? 'POST' : 'PUT'" :action="old('_action') ?? ''" id="crud-form">
                    <x-input type="hidden" id="input-mode" name="mode" value="tambah" />
                    <x-input label="Nama Role" id="input-nama" name="nama" class="mb-3" required />
                    <div class="d-flex">
                        <x-button size="lg" icon="fa-paper-plane" type="submit" class="mr-2">Simpan</x-button>
                        <div id="crud-buttons" class="{{ empty(old('mode')) || old('mode') == 'tambah' ? 'd-none' : '' }}">
                            <x-button size="lg" icon="fa-xmark" color="warning" id="btn-batal">Batal</x-button>
                        </div>
                    </div>
                </x-form>
            </x-card>
        </div>
    </div>

    <x-form id="form-delete" method="DELETE" action=""></x-form>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            datatablesInit({
                selector: "#table",
                url: "{{ route('admin.role.index') }}",
                columns: [
                    { data: "Nama" },
                ],
                withAction: true,
            })
        })

        $(document).on('click', '.btn-edit', function() {
            const id = $(this).data('id')
            const nama = $(this).data('nama')
            const url = "{{ route('admin.role.update', '-id-') }}".replace('-id-', id)

            $('#crud-header').html('Ubah Role')
            $("#crud-form").attr('action', url)
            $("#crud-form").find("input[name='_method']").eq(0).val('PUT')
            $("#crud-form").find("input[name='_action']").eq(0).val(url)
            $("#input-nama").val(nama)
            $("#input-mode").val('ubah')
            $("#crud-buttons").removeClass('d-none')
        })

        $(document).on('click', '.btn-delete', function() {
            const id = $(this).data('id')
            const nama = $(this).data('nama')
            NegativeConfirm.fire({
                title: 'Yakin ingin menghapus ' + nama + '?',
            }).then((result) => {
                if (result.isConfirmed) {
                    loading()
                    $("#form-delete").attr('action', "{{ route('admin.role.destroy', ['-id-']) }}".replace('-id-', id)).submit()
                }
            })
        })

        $("#btn-batal").click(function() {
            $('#crud-header').html('Tambah Role')
            $("#crud-form").attr('action', "{{ route('admin.role.index') }}")
            $("#crud-form").find("input[name='_method']").eq(0).val('POST')
            $("#crud-form").find("input[name='_action']").eq(0).val('')
            $("#input-nama").val("")
            $("#input-mode").val('tambah')
            $("#crud-buttons").addClass('d-none')
        })
    </script>
@endpush
