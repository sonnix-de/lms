    <header>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="{{route('welcome')}}">{{ config('app.name', 'Laravel') }}</a>
    <button class="navbar-toggler collapsed" 
    type="button" 
    data-toggle="collapse" 
    data-target="#navbarSupportedContent" 
    aria-controls="navbarSupportedContent" 
    aria-expanded="false" 
    aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="nav navbar-nav">
            @guest
            {!! \App\Helper\Helpers::getNavigationLink('Start','lms-start') !!}
            {!! \App\Helper\Helpers::getNavigationLink('Medien','lms-medien') !!}
            @else
            {!! \App\Helper\Helpers::getNavigationLink('Start','lms-start') !!}
            {!! \App\Helper\Helpers::getNavigationLink('Medien','lms-medien') !!}
            {!! \App\Helper\Helpers::getNavigationLink('Ausleihen','lms-lends') !!}
            {!! \App\Helper\Helpers::getNavigationLink('User','lms-user') !!}
            {!! \App\Helper\Helpers::getNavigationLink('Service','lms-service') !!}
            @endguest
      </ul>
      <ul class="navbar-nav nav-right">
        @guest
        {!! \App\Helper\Helpers::getNavigationLink('Login','login') !!}
        {!! \App\Helper\Helpers::getNavigationLink('Register','register') !!}
            @else
        <li class="nav-item dropdown">
            <a 
                href="#" 
                id="navbarDropdownMenuLink"
                class="nav-link dropdown-toggle" 
                data-toggle="dropdown" 
                role="button" 
                aria-expanded="false" 
                aria-haspopup="true">
                {{ Auth::user()->name }}
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
            </div>
        </li>
    @endguest
    </ul>
    </div>
  </nav>                    
</header>