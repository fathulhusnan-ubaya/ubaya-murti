@php
    $judul = 'Tambah Menu';
    if (isset($menu)) $judul = 'Detail Menu';
@endphp

@extends('layouts.admin', [
    'judul' => $judul,
    'breadcrumbs' => [
        [
            'url' => '#',
            'title' => "Administrator",
        ],
        [
            'url' => route('admin.menu.index'),
            'title' => "Menu",
        ],
    ]
])

@section('contents')
    <div class="row">
        <div class="col-md-5">
            <x-card :header="$judul">
                <x-form :method="empty($menu) ? 'POST' : 'PUT'" :action="empty($menu) ? route('admin.menu.store') : route('admin.menu.update', $menu)" submit="Simpan">
                    <x-input label="Judul" id="input-judul" name="judul" :value="$menu->Judul ?? ''" class="mb-3" required/>
                    <x-select label="Route Name" id="input-route-name" name="route_name" :options="$daftarRoute" :value="$menu->RouteName ?? ''" class="mb-3" required />
                    <div class="mb-3">
                        <x-label>Route Param </x-label>
                        <div id="container-route-param">
                            @empty(old('route_param_key'))
                                @forelse ($menu->RouteParams ?? [] as $key => $value)
                                    <div class="d-flex align-items-center">
                                        <x-input name="route_param_key[]" placeholder="key" :value="$key" class="w-50" />
                                        <x-input name="route_param_value[]" placeholder="value" :value="$value" class="w-100" />
                                        <a href="javascript:;" class="fa-solid fa-xmark text-danger ml-2 remove-route-param" data-toggle="tooltip" data-placement="top" title="Hapus" style="cursor:pointer;"></a>
                                    </div>
                                @empty
                                @endforelse
                            @else
                                @foreach (old('route_param_key') as $key => $route_key)
                                    <div class="d-flex align-items-center">
                                        <x-input name="route_param_key[]" placeholder="key" :value="$route_key" class="w-50" />
                                        <x-input name="route_param_value[]" placeholder="value" :value="old('route_param_value')[$key]" class="w-100" />
                                        <a href="javascript:;" class="fa-solid fa-xmark text-danger ml-2 remove-route-param" data-toggle="tooltip" data-placement="top" title="Hapus" style="cursor:pointer;"></a>
                                    </div>
                                @endforeach
                            @endempty
                        </div>
                        <x-button icon="fa-plus" class="btn-block" id="add-route-param">Tambah</x-button>
                    </div>
                    <x-select label="Menu Induk" id="input-induk" name="induk" :options="$daftarInduk" :value="$menu->IdMenuParent ?? ''" class="mb-3" />
                    <x-input label="Urutan" id="input-urutan" name="urutan" value="{{ $noUrutTanpaInduk }}" type="number" min="1" max="{{ $noUrutTanpaInduk }}" class="mb-3" required />
                    <div class="d-flex" style="gap: 20px">
                        <x-input id="input-icon" name="icon" :value="$menu->Icon ?? ''" class="mb-3 w-50">
                            <x-slot name="label">
                                Icon (<a href="https://feathericons.com/" target="_blank" class="font-weight-bold">Feather Icon</a>)
                            </x-slot>
                        </x-input>
                        <div class="w-50">
                            <x-label for="input-is-aktif">Aktif</x-label>
                            <x-tick id="input-is-aktif" name="is_aktif" type="switch" checked />
                        </div>
                    </div>
                </x-form>
            </x-card>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        let noUrutTanpaInduk = {{ $noUrutTanpaInduk }};
        let lastSavedInduk = null;
        let addition = 1;

        $(document).ready(function() {
            lastSavedInduk = {{ old('induk') ?? $menu->IdMenuParent ?? 'null' }};

            @empty((old('urutan') ?? $menu->Urutan ?? NULL)) @else
                setTimeout(() => {
                    $("#input-urutan").val({{ old('urutan') ?? $menu->Urutan }})
                }, 1000);
            @endempty

            $("#input-induk").change()
        })

        $("#input-induk").change(function() {
            @empty($menu) @else
                if ("{{ $menu->IdMenuParent }}" == $(this).val()) addition = 0
                else addition = 1
            @endempty

            $("#input-urutan").val(noUrutTanpaInduk)
            $("#input-urutan").attr('max', noUrutTanpaInduk)

            if ($(this).val() != '') {
                ajaxGetRequest({
                    url: "{{ route('admin.menu.urutan', '-menu-') }}".replace('-menu-', $(this).val()),
                    successCallback: function(result) {
                        $("#input-urutan").val(parseInt(result) + addition)
                        $("#input-urutan").attr('max', parseInt(result) + addition)
                    },
                    errorCallback: function(error) {
                        Toast.fire({
                            icon: 'error',
                            title: "Terjadi masalah pada server!",
                            text: "Harap hubungi Direktorat SIM untuk informasi lebih lanjut!"
                        })
                        console.error(error);
                    }
                })
            }
        })

        $("#add-route-param").click(function() {
            $("#container-route-param").append(`
                <div class="d-flex align-items-center">
                    <x-input name="route_param_key[]" placeholder="key" class="w-50" />
                    <x-input name="route_param_value[]" placeholder="value" class="w-100" />
                    <a href="javascript:;" class="fa-solid fa-xmark text-danger ml-2 remove-route-param" data-toggle="tooltip" data-placement="top" title="Hapus" style="cursor:pointer;" role="button"></a>
                </div>
            `)
            $("[data-toggle=tooltip]").tooltip()
        })

        $(document).on('click', '.remove-route-param', function() {
            $(this).parent().remove()
            $(".tooltip").remove()
        })
    </script>
@endpush
