<nav class="navbar navbar-expand-lg navbar-light bg-info">
    <a class="navbar-brand text-light" href="/">VehicleBookr</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li class="mr-4"><a href="/vehicles/create" class="text-light">Add Vehicle</a></li>
            <li class="mr-4"><a href="/vehicles" class="text-light">Book Vehicle</a></li>
            <li class="mr-5"><a href="#" class="text-light" data-toggle="modal" data-target="#reportVehicleModal">Report
                    Vehicle</a></li>
            <!-- Authentication Links -->
            @guest
            <li class="mr-5"><a href="{{ route('login') }}" class="text-light">Login</a></li>
            <li class="mr-5"><a href="{{ route('register') }}" class="text-light">Register</a></li>
            @else
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle text-light" data-toggle="dropdown" role="button"
                       aria-expanded="false" aria-haspopup="true">
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu">
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
                @endguest
        </ul>
    </div>
</nav>