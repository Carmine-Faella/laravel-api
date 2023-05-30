<div class="d-flex flex-column flex-shrink-0 p-2 bg-body-tertiary border-end">
  <div class="sidebar_top">
    <a href="{{route('admin.projects.index')}}" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
      <span class="fs-4">Home</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
      <li class="nav-item">
        <a href="{{route('admin.dashboard')}}" class="nav-link {{Route::currentRouteName() == 'admin.dashboard'?'active':''}}">
          Dashboard
        </a>
      </li>
      <li class="nav-item">
        <a href="{{route('admin.projects.index')}}" class="nav-link @if (Route::currentRouteName() == 'admin.projects.index') active @endif">
          Projects
        </a>
      </li>
      <li class="nav-item">
        <a href="{{route('admin.types.index')}}" class="nav-link @if (Route::currentRouteName() == 'admin.types.index') active @endif">
          Types
        </a>
      </li>
      <li class="nav-item">
        <a href="{{route('admin.tecnologies.index')}}" class="nav-link @if (Route::currentRouteName() == 'admin.tecnologies.index') active @endif">
          Techs
        </a>
      </li>
      <li class="nav-item">
        <a href="{{route('admin.projects.create')}}" class="nav-link @if (Route::currentRouteName() == 'admin.projects.create') active @endif">
          New Project
        </a>
      </li>
      <li class="nav-item">
        <a href="{{route('admin.types.create')}}" class="nav-link @if (Route::currentRouteName() == 'admin.types.create') active @endif">
          New Type
        </a>
      </li>
      <li class="nav-item">
        <a href="{{route('admin.tecnologies.create')}}" class="nav-link @if (Route::currentRouteName() == 'admin.tecnologies.create') active @endif">
          New Tech
        </a>
      </li>
    </ul>
  </div>
    <hr>
    <div class="dropdown sidebar_down">
      <ul class="navbar-nav ml-auto">
        <!-- Authentication Links -->
        @guest
        <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
        </li>
        @if (Route::has('register'))
        <li class="nav-item">
            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
        </li>
        @endif
        @else
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }}
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('admin.dashboard') }}">{{__('Dashboard')}}</a>
                <a class="dropdown-item" href="{{ url('profile') }}">{{__('Profile')}}</a>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>
        @endguest
    </ul>
    </div>
  </div>