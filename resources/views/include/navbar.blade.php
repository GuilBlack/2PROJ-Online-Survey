{{-- <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
    <h5 class="my-0 mr-md-auto font-weight-normal"><a href="/" id="jenesaispasquoimettreici">{{config('app.name', 'Online Survey')}}</a></h5>
    <nav class="my-2 my-md-0 mr-md-3">
      
    </nav>
    <a class="btn btn-outline-primary" href="#">Sign In</a>
  </div> --}}

  <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
      <h5 class="my-0 mr-md-auto font-weight-normal"><a href="/" id="jenesaispasquoimettreici">{{config('app.name', 'Online Survey')}}</a></h5>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
              <a class="p-2 text-dark" href="/">Home</a>
              <a class="p-2 text-dark" href="/general-survey">Survey</a>
              <a class="p-2 text-dark" href="/about">About Us</a>
              <a class="p-2 text-dark" href="/support">Support</a>
                <!-- Authentication Links -->
                @guest
                    {{-- <li> --}}
                        <a class="btn btn-outline-primary" href="{{ route('login') }}">{{ __('Login') }}</a>
                    {{-- </li> --}}
                    @if (Route::has('register'))
                        {{-- <li> --}}
                            <a class="btn btn-outline-primary" href="{{ route('register') }}">{{ __('Register') }}</a>
                        {{-- </li> --}}
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
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
                @endguest
            </ul>
        </div>
    </div>
</nav>