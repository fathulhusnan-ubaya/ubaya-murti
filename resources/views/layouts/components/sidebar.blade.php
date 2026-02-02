<div class="sidebar-menu">
    <ul class="menu-items">
        <li class="m-t-15 @if(Route::is('dashboard') || Route::is("user.*")) active @endif">
            <a href="{{ config('app.url') }}">
                <span class="title">Dashboard</span>
            </a>
            <span class="icon-thumbnail"><i data-feather="home"></i></span>
        </li>
        @foreach (session('my')->Menu as $menu)
            @if ($menu->Child?->count() > 0)
                <li class="@if(Route::is($menu->RouteName)) open active @endif">
                    <a href="javascript:;">
                        <span class="title">{{ $menu->Judul }}</span>
                        <span class="arrow"></span>
                    </a>
                    @empty($menu->Icon) @else
                        <span class="icon-thumbnail mr-1"><i data-feather="{{ $menu->Icon }}"></i></span>
                    @endempty
                    <ul class="sub-menu">
                        @foreach ($menu->Child as $child)
                            @php
                                $indexRoute = $child->RouteName;
                                if (!str($indexRoute)->endsWith('*')) {
                                    $names = explode('.', $child->RouteName);
                                    $indexRoute = '';
                                    for ($i=0; $i < count($names) - 1; $i++) {
                                        $indexRoute .= $names[$i] . ".";
                                    }
                                    $indexRoute .= "*";
                                }
                            @endphp
                            <li class="@if(Route::is($indexRoute)) active @endif">
                                <a href="@if(Route::has($child->RouteName)) {{ route($child->RouteName, $child->RouteParams) }} @else {{ 'javascript:;' }} @endif">
                                    {{ $child->Judul }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @else
                @php
                    $indexRoute = $menu->RouteName;
                    if (!str($indexRoute)->endsWith('*')) {
                        $names = explode('.', $menu->RouteName);
                        $indexRoute = '';
                        for ($i=0; $i < count($names) - 1; $i++) {
                            $indexRoute .= $names[$i] . ".";
                        }
                        $indexRoute .= "*";
                    }
                @endphp
                <li class="@if(Route::is($indexRoute)) active @endif">
                    <a href="@if(Route::has($menu->RouteName)) {{ str($menu->RouteName)->endsWith('*') ? 'javascript:;' : route($menu->RouteName, $menu->RouteParams) }} @else {{ 'javascript:;' }} @endif">
                        <span class="title">{{ $menu->Judul }}</span>
                    </a>
                    @empty($menu->Icon) @else
                        <span class="icon-thumbnail"><i data-feather="{{ $menu->Icon }}"></i></span>
                    @endempty
                </li>
            @endif
        @endforeach
        <li class="d-block d-lg-none">
            <a href="javascript:void();" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <span class="title">Logout</span>
            </a>
            <span class="icon-thumbnail"><i data-feather="log-out"></i></span>
        </li>
    </ul>
    <div class="clearfix"></div>
</div>
