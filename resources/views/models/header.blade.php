<header class="sticky-top">
    <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-dark bg-dark" role="navigation">
        <div class="container-fluid">
            <a class="navbar-brand fs-2" href="/">網頁開發學習資源資料庫</a>
            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav"
                aria-controls="navbarNav"
                aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse flex-row-reverse fs-4" id="navbarNav">
                <ul class="navbar-nav navbar-nav-scroll">
                    @foreach($navBar as $navItem => $navSetting)
                    <li class="nav-item">
                        <a class="nav-link {{ ( Request::segment(1) != $navItem ) ?: 'active' }} " href="{{ url($navSetting['url']) }}">
                            {{ $navSetting['label'] }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </nav>
</header>