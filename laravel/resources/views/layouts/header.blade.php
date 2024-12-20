<nav class="navbar navbar-expand-md navbar-light shadow-sm pdm-bg-black" style="z-index:200;">
    <div>
        <a href="{{ route('dashboard') }}">
            <img src="{{ asset('/wbc/images/webike_logo_white.png') }}" height="40px">
        </a>
        <div class="text-white" style="font-size: 11px;">PDM (Product Data Management)</div>
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Left Side Of Navbar -->
        <ul class="navbar-nav mr-auto">

        </ul>

        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto align-items-center">
            <!-- Authentication Links -->
            @guest
            @else
                <li class="nav-item mr-3">
                    <a class="nav-link p-1 bg-white d-flex align-items-center" style="border-radius: 8px;" target="_blank"
                       href="{{ url(config('url.portal_url') . '/?password_protected_pwd=we819wbc&redirect_to=' . urlencode(config('url.portal_url') . '?pdm=1'), null, true) }}">
                        <img class="mt-0 mr-auto ml-auto" src="{{ asset(config('url.portal_url') . '/wp-content/uploads/2022/03/cropped-wbc_site_icon.png', true) }}" alt="WBC logo" width="32" height="32">
                        <div class="ml-1">ポータルサイトは<span class="ml-1 bg-primary text-white rounded p-1">こちら</span></div>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" style="width: 150px;"
                       class="nav-link dropdown-toggle btn btn-light btn-sm font-weight-bold" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <i class="fas fa-user"></i> {{ session('display-name') }} 様
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a id="dropdownmenu_list" class="dropdown-item font-weight-bold" href="{{ route('dashboard') }}">
                            <i class="fas fa-chart-bar"></i> ダッシュボード
                        </a>
                        <a id="dropdownmenu_list" class="dropdown-item font-weight-bold" href="{{ route('registration.list') }}">
                            <i class="fas fa-file-signature"></i> 新規商品登録
                        </a>
                        <a id="dropdownmenu_list" class="dropdown-item font-weight-bold" href="{{ route('edition.list') }}">
                            <i class="fas fa-screwdriver-wrench"></i> 商品データ修正・更新
                        </a>
                        <a id="dropdownmenu_list" class="dropdown-item font-weight-bold" href="{{ route('home') }}">
                            <i class="fas fa-up-down"></i> 廃番・復活
                        </a>
                        <!-- <a id="dropdownmenu_list" class="dropdown-item font-weight-bold" href="#">
                            <i class="fas fa-home"></i> ホーム
                        </a> -->
                        <div class="dropdown-divider"></div>

                        <a class="dropdown-item font-weight-bold" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i> ログアウト
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </ul>
    </div>
</nav>
