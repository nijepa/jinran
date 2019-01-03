<header role="banner" class="position-absolute">
    <!-- Top Navigation -->
    <nav class="background-transparent background-primary-dott full-width sticky">
        <div class="top-nav">
            <!-- mobile version logo -->
            <div class="logo hide-l hide-xl hide-xxl">
                <a href="index.html" class="logo">
                    <!-- Logo White Version -->
                    <img class="logo-white" src="/images/frontend_images/logo.png" alt="">
                    <!-- Logo Dark Version -->
                    <img class="logo-dark" src="/images/frontend_images/logo-dark.png" alt="">
                </a>
            </div>
            <p class="nav-text"></p>

            <!-- left menu items -->
            <div class="top-nav left-menu">
                <ul class="right top-ul chevron">
                    <li><a href="{{ url('home') }}">Home</a></li>
                    <li><a href="{{ url('author/about') }}">About Us</a></li>
                    <li><a href="{{ url('author/meetings') }}">Meetings</a></li>
                </ul>
            </div>

            <!-- logo -->
            <ul class="logo-menu">
                <a href="index.html" class="logo">
                    <!-- Logo White Version -->
                    <img class="logo-white" src="/images/frontend_images/logo.png" alt="">
                    <!-- Logo Dark Version -->
                    <img class="logo-dark" src="/images/frontend_images/logo-dark.png" alt="">
                </a>
            </ul>

            <!-- right menu items -->
            <div class="top-nav right-menu">
                <ul class="top-ul chevron">
                    <li><a href="{{ url('author/projects') }}">Projects</a></li>
                    <!--<li>
                        <a>Comments</a>
                        <ul>
                            <li><a>Replies</a></li>
                            <li><a>Documents</a></li>
                        </ul>
                    </li>-->
                    <li><a href="{{ url('author/contact') }}">Contact</a></li>
                    <li>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <ul>
                            <li>
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
</header>