<header>
    <div class="px-3 py-2 navbar-dark bg-primary">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="{{ url('/') }}"
                    class="d-block my-2 my-lg-0 me-lg-auto text-decoration-none @if (request()->segment(1) == null) text-white @else text-white-50 @endif">
                    <i class="bi bi-house-fill d-block text-center" style="font-size: 1rem;"></i>
                    Lumen Event79
                </a>

                <ul class="nav col-12 col-lg-auto my-2 justify-content-center my-md-0 text-small">
                    <li class="me-5">
                        <a href="{{ url('event/add') }}"
                            class="nav-link @if (request()->segment(1) == 'event') text-white @else text-white-50 @endif">
                            <i class="bi bi-menu-button-wide-fill d-block text-center" style="font-size: 1rem;"></i>
                            Add Event
                        </a>
                    </li>
                    <li class="me-5">
                        <a href="{{ url('dashboard') }}"
                            class="nav-link @if (request()->segment(1) == 'dashboard') text-white @else text-white-50 @endif">
                            <i class="bi bi-speedometer2 d-block text-center" style="font-size: 1rem;"></i>
                            Dashboard
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>
