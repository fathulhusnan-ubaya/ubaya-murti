<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title>{{ !empty($judul) ? "$judul - " : ''}} Murti</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no" />
    {{-- <link rel="apple-touch-icon" href="{{ asset('pages/ico/60.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('/pages/ico/76.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('pages/ico/120.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('pages/ico/152.png') }}"> --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta content="Kopertis7 - aplikasi untuk pengajuan jabatan akademik." name="description" />
    <meta content="Ace" name="author" />
    <meta content="{{ csrf_token() }}" name="csrf-token">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="{{ asset('plugins/pace/pace-theme-flash.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/jquery-scrollbar/jquery.scrollbar.css') }}" rel="stylesheet" type="text/css" media="screen" />
    <link href="{{ asset('plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" media="screen" />
    <link href="{{ asset('plugins/jquery-datatable/extensions/FixedColumns/css/dataTables.fixedColumns.min.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" media="screen" />
    <link href="{{ asset('plugins/bootstrap-datepicker/css/datepicker3.css') }}" rel="stylesheet" type="text/css" media="screen">
    <link class="main-stylesheet" href="{{ asset('pages/css/themes/light.css') }}" rel="stylesheet" type="text/css" />
    <link class="main-stylesheet" href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/js/all.min.js" integrity="sha512-6sSYJqDreZRZGkJ3b+YfdhB3MzmuP9R7X1QZ6g5aIXhRvR1Y/N/P47jmnkENm7YL3oqsmI6AK+V6AD99uWDnIw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @stack('styles')
</head>
<body class="fixed-header menu-pin" style="height: 100% !important;">
    @include('sweetalert::alert')
    <nav class="page-sidebar shadow-sm" data-pages="sidebar">
        {{-- Logo --}}
        <div class="sidebar-header text-center mt-4">
            <img src="{{ asset('img/logo.png') }}" alt="logo" data-src="{{ asset('img/logo.png') }}" data-src-retina="{{ asset('img/logo.png') }}" width="100%">
        </div>

        {{-- Sidebar Menu --}}
        @include('layouts.components.sidebar')
    </nav>

    {{-- Container --}}
    <div class="page-container ">
        <div class="header bg-white">
            {{-- Mobile Menu Toggle --}}
            <a href="#" class="btn-link toggle-sidebar d-lg-none pg-icon btn-icon-link" data-toggle="sidebar">menu</a>

            <div class="">
            </div>

            {{-- User --}}
            <div class="d-flex align-items-center">
                <div class="pull-left p-r-10 fs-14 d-lg-inline-block d-none m-l-20">
                    <span class="bold">{{ auth()->user()->name }}</span>
                </div>
                <div class="dropdown pull-right d-lg-block d-none">
                    <button class="profile-dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="profile dropdown">
                        <span class="thumbnail-wrapper d32 circular inline">
                            <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}" alt="{{ auth()->user()->name }}" data-src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}" data-src-retina="https://ui-avatars.com/api/?name={{ auth()->user()->name }}" width="32" height="32">
                        </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right profile-dropdown" role="menu">
                        <div class="dropdown-item"><span><b>{{ auth()->user()->name }}</b><br>{{ session('my')->RoleAktif->Nama }}</span></div>
                        <div class="dropdown-divider"></div>
                        <a href="javascript:void();" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item">Logout</a>
                    </div>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>

        <div class="page-content-wrapper ">
            <div class="content ">
                <div class="container-fluid sm-p-l-0 sm-p-r-0">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="inner mb-3 border-bottom">
                                <h3 class="mb-1 ml-1"><b><?= $judul ?></b></h3>
                                <ol class="breadcrumb pt-0 pb-2">
                                    <li class="breadcrumb-item"><a href="{{ config('app.url') }}">Dashboard</a></li>
                                    @isset($breadcrumbs)
                                        @foreach ($breadcrumbs as $breadcrumb)
                                            <li class="breadcrumb-item"><a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['title'] }}</a></li>
                                        @endforeach
                                    @endisset
                                    @if($judul == 'Dashboard') @else <li class="breadcrumb-item active"><a href="{{ request()->url() }}">{{ $judul }}</a></li> @endif
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container-fluid">
                    @yield('contents')
                </div>
            </div>

            <div class="container-fluid footer">
                <div class="copyright sm-text-center">
                    <p class="small-text no-margin pull-left sm-pull-reset">
                        ©2026 All Rights Reserved. Murti dibuat oleh Sistem Informasi Manajemen Universitas Surabaya.
                    </p>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>

    @yield('quickview')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" type="text/javascript"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <script src="{{ asset('plugins/pace/pace.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('plugins/liga.js') }}" type="text/javascript"></script>
    <script src="{{ asset('plugins/modernizr.custom.js') }}" type="text/javascript"></script>
    <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('plugins/popper/umd/popper.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('plugins/jquery/jquery-easy.js') }}" type="text/javascript"></script>
    <script src="{{ asset('plugins/jquery-unveil/jquery.unveil.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('plugins/jquery-ios-list/jquery.ioslist.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('plugins/jquery-actual/jquery.actual.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('plugins/jquery-scrollbar/jquery.scrollbar.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('plugins/classie/classie.js') }}" type="text/javascript"></script>
    <script src="{{ asset('plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('plugins/jquery-datatable/media/js/jquery.dataTables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('plugins/jquery-datatable/extensions/TableTools/js/dataTables.tableTools.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('plugins/jquery-datatable/media/js/dataTables.bootstrap.js') }}" type="text/javascript"></script>
    <script src="{{ asset('plugins/jquery-datatable/extensions/Bootstrap/jquery-datatable-bootstrap.js') }}" type="text/javascript"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/datatables.responsive.js') }}" type="text/javascript"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/lodash.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('plugins/jquery-datatable/extensions/FixedColumns/js/dataTables.fixedColumns.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('plugins/jquery-inputmask/jquery.inputmask.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}" type="text/javascript"></script>
    <script src="{{ asset('pages/js/pages.min.js') }}"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="{{ asset('js/fth-function.js') }}?v={{ time() }}"></script>
    <script>
        $(document).ready(function() {
            if (document.getElementsByClassName("is-invalid").length) {
                const scrollToErrorPos = document.getElementsByClassName("is-invalid")[0].getBoundingClientRect().top + window.pageYOffset - 110;

                window.scrollTo({
                    top: scrollToErrorPos,
                    behavior: "smooth"
                });
            }
        })

        $(document).on('click', '.btn-dismiss', function() {
            $(this).parent().closest('div').remove();
        })

        // Redirect to login page when session ends for datatable
        $(document).ready(function() {
            // Disable DataTable error messages
            $.fn.dataTable.ext.errMode = 'none';

            // Custom DataTable error handling (prevents popups)
            $.fn.dataTable.ext.errMode = function(settings, helpPage, message) {
                if (settings.jqXHR && (settings.jqXHR.status === 401 || settings.jqXHR.status === 419)) {
                    window.location.href = "{{ route('login') }}";
                } else {
                    console.error("DataTable error:", message);
                }
            };
        });
    </script>
    <script type="text/javascript">
        // prevent multiple submit on same form
        // https://stackoverflow.com/a/926863
        $("body").on("submit", "form", function() {
            $(this).submit(function() {
                return false;
            });
            return true;
        });
    </script>
    @stack('scripts')
</body>
</html>