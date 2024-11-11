<header class="sticky-top">
    <nav class="{{ $navClass }}" role="navigation">
        <div class="container-fluid">
            <a class="navbar-brand fs-2" href="{{ route('home') }}">{{ $title }}</a>
            <button {{ $attributes->merge($buttonAttr) }}>
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="{{ $divClass }}" id="navbarNav">
                <ul class="navbar-nav navbar-nav-scroll">
                    @foreach ($navBar as $navItem => $navSetting)
                        <li class="nav-item">
                            <a class="nav-link {{ $currentPage($navItem) }}" href="{{ url($navSetting['url']) }}">
                                {{ $navSetting['label'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </nav>
</header>
