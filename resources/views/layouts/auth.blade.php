<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title>{{ !empty($judul) ? "$judul - " : ''}} Murti</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no" />
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta content="Kopertis7 - aplikasi untuk pengajuan jabatan akademik." name="description" />
    <meta content="Ace" name="author" />
    <link href="{{ asset('plugins/pace/pace-theme-flash.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="{{ asset('plugins/jquery-scrollbar/jquery.scrollbar.css') }}" rel="stylesheet" type="text/css" media="screen" />
    <link href="{{ asset('plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" media="screen" />
    <link class="main-stylesheet" href="{{ asset('pages/css/themes/light.css') }}" rel="stylesheet" type="text/css" />
    <link class="main-stylesheet" href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/js/all.min.js" integrity="sha512-6sSYJqDreZRZGkJ3b+YfdhB3MzmuP9R7X1QZ6g5aIXhRvR1Y/N/P47jmnkENm7YL3oqsmI6AK+V6AD99uWDnIw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>    
    @stack('styles')
</head>
<body class="fixed-header menu-pin">
    <div class="login-wrapper">
        <div class="bg-pic">
            <img src="{{ asset('img/login-bg.png') }}" alt="" width="75%">
            <div class="bg-caption pull-bottom sm-pull-bottom text-white p-l-20 m-b-20">
                <h1 class="semi-bold text-white">
                    Murti
                </h1>
            </div>
        </div>
        <div class="login-container bg-white">
            <div class="p-l-50 p-r-50 p-t-50 m-t-30 sm-p-l-15 sm-p-r-15 sm-p-t-40">
                <img src="{{ asset('img/logo.png') }}" alt="logo" data-src="{{ asset('img/logo.png') }}" data-src-retina="{{ asset('img/logo.png') }}" width="100%">
                <h2 class="p-t-25">{{ $judul }}</h2>

                @yield('content')

                <div class="mt-5" style="width: 400px;">
                    <div class="m-b-30 p-r-80 sm-m-t-20 sm-p-r-15 sm-p-b-20 clearfix">
                        <div class="col-sm-9 no-padding m-t-10">
                            <p class="small-text normal hint-text">
                                © 2026.<br>Dikembangkan oleh Sistem Informasi Manajemen Universitas Surabaya.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('plugins/pace/pace.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('plugins/liga.js') }}" type="text/javascript"></script>
    <script src="{{ asset('plugins/jquery/jquery-3.2.1.min.js') }}" type="text/javascript"></script>
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
    <script src="{{ asset('pages/js/pages.min.js') }}"></script>
    @stack('scripts')

</body>
</html>
