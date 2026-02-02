@extends('layouts.admin', [
    'judul' => 'Dashboard',
])

@section('contents')
    <div class="row">
        <div class="col-lg-12">
            <div class="feed">
                <div class="day" data-social="day">
                    <div class="card card-borderless no-border mb-2 full-width" data-social="item">
                        <div class="container-fluid p-t-30 p-b-30 ">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="container-xs-height">
                                        <div class="row-xs-height">
                                            <div class="social-user-profile col-xs-height text-center col-top">
                                                <div class="thumbnail-wrapper d48 circular bordered b-white">
                                                    <img alt="{{ auth()->user()->name }}" data-src-retina="https://ui-avatars.com/api/?name={{ auth()->user()->name }}" data-src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}" src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}" width="55" height="55" style="object-fit: cover;object-position: 50% 0px;">
                                                </div>
                                                <br>
                                                <i class="pg-icon text-success m-t-10">tick_circle</i>
                                            </div>
                                            <div class="col-xs-height p-l-20">
                                                <h3 class="no-margin p-b-5">{{ auth()->user()->name }}</h3>
                                                <p class="no-margin fs-16">Selamat datang di Portal Murti</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
