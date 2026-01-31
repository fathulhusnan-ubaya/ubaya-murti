@extends('layouts.admin', [
    'judul' => 'Privilege',
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
            <x-card header="Daftar Privilege">
                <x-table id="table">
                    <x-slot name="thead">
                        <tr>
                            <td width="50px">No.</td>
                            <td>Role</td>
                            <td>Menu</td>
                            <td>Level</td>
                            <td class="d-none">RouteName</td>
                            <td width="110px">Aksi</td>
                        </tr>
                    </x-slot>
                </x-table>
            </x-card>
        </div>
        <div class="col-md-4">
            <x-card header="Setting Privilege" id="crud">
                <x-form method="POST" :action="old('_action') ?? ''" id="crud-form">
                    <x-select label="Role" id="input-role" name="role[]" route="select2.role" class="mb-3" required multiple />
                    <x-select label="Menu" id="input-menu" name="menu[]" route="select2.menu" class="mb-3" required multiple />
                    <x-input label="Level" id="input-level" name="level" class="mb-3" type="number" value="90" min="0" max="90" required />
                    <div class="d-flex">
                        <x-button size="lg" icon="fa-paper-plane" type="submit" class="mr-2">Simpan</x-button>
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
                url: "{{ route('admin.privilege.index') }}",
                columns: [
                    { data: "Role", name: "R.Nama" },
                    { data: "Menu", name: "M.Judul" },
                    { data: "Level", className: 'text-center' },
                    { data: "RouteName", name: "M.RouteName", visible: false, sortable: false },
                ],
                withAction: true,
            })
        })

        $(document).on('click', '.btn-delete', function() {
            const role = $(this).data('role')
            const menu = $(this).data('menu')
            NegativeConfirm.fire({
                title: 'Yakin ingin menghapus privilege ini?',
            }).then((result) => {
                if (result.isConfirmed) {
                    loading()
                    $("#form-delete").attr('action', "{{ route('admin.privilege.destroy', ['-role-', '-menu-']) }}".replace('-role-', role).replace('-menu-', menu)).submit()
                }
            })
        })
    </script>
@endpush
