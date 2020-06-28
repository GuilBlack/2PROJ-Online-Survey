{{-- <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
    <h5 class="my-0 mr-md-auto font-weight-normal"><a href="/" id="jenesaispasquoimettreici">{{config('app.name', 'Online Survey')}}</a></h5>
    <nav class="my-2 my-md-0 mr-md-3">
      
    </nav>
    <a class="btn btn-outline-primary" href="#">Sign In</a>
  </div> --}}

  <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
      <h5 class="my-0 mr-md-auto font-weight-normal"><a href="/" id="jenesaispasquoimettreici" style="font-size: 25px; margin-right: 0.5em">{{config('app.name', 'Online Survey')}}</a></h5>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                 
                <a class="p-2 text-dark" style="margin-right: 0.5em; float: right" href="/">
                    <div style=" text-align: center;">
                        <span class="material-icons" style="font-size: 30px;">home</span>
                        <h6 style="margin:auto;">Home</h6>
                    </div>
                </a>
                <a class="p-2 text-dark" style="margin-right: 0.5em; float: right" href="/general-survey">
                    <div style=" text-align: center;">
                        <span class="material-icons" style="font-size: 30px">assignment</span>
                        <h6 style="margin:auto;">Take Survey</h6>
                    </div>
                </a>
                <a class="p-2 text-dark" style="margin-right: 0.5em; float: right" href="/about">
                    <div style=" text-align: center;">
                        <span class="material-icons" style="font-size: 30px">help</span>
                        <h6 style="margin:auto;">About Us</h6>
                    </div>
                </a>
                <a class="p-2 text-dark" style="margin-right: 0.5em; float: right" href="/support">
                    <div style=" text-align: center;">
                        <span class="material-icons" style="font-size: 30px">email</span>
                        <h6 style="margin:auto;">Contact Us</h6>
                    </div>
                </a>
                <!-- Authentication Links -->
                @guest
                    {{-- <li> --}}
                        <a class="nav-link" style="margin-right: 0.5em; float: right" href="{{ route('login') }}">{{ __('Login') }}</a>
                    {{-- </li> --}}
                    @if (Route::has('register'))
                        {{-- <li> --}}
                            <a class="nav-link" style="margin-right: 0.5em; float: right" href="{{ route('register') }}">{{ __('Register') }}</a>
                        {{-- </li> --}}
                    @endif
                @else
                    <div style=" text-align: center;">
                        <li id="navbar-user-dropdown" class="nav-item dropdown" style="margin-right: 0.5em; float: right">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <span class="material-icons" style="font-size: 30px">person</span>
                                <h6 style="margin:auto;">{{ Auth::user()->name }}<h6>
                            </a>

                            <div id="navbar-dropdown-items" class="dropdown-menu dropdown-menu-right" aria-labelledby="#navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </div>
                @endguest
            </ul>
        </div>
    </div>
</nav>