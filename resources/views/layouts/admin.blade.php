<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Likometa Aeroport">
    <meta name="author" content="Gerald Ibra">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/sb-Admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/Admin-custom.css') }}" rel="stylesheet">

    <!-- Favicon -->
    <link href="{{ asset('img/favicon.png') }}" rel="icon" type="image/png">

    <!-- Scripts -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

</head>
<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route("home")}}">
            <div style="background-color: white; border-radius: 50%;" class="sidebar-brand-icon">
                <img width="100" height="40" src="{{URL::to('../img/LIKOMETAJ-LOGO.png')}}" />
            </div>
{{--            <div class="sidebar-brand-icon rotate-n-15">--}}
{{--                <i class="fas fa-laugh-wink"></i>--}}
{{--            </div>--}}
            <div class="sidebar-brand-text mx-3"></div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        @if(Gate::allows('Admin-access'))
            <!-- Nav Item - Dashboard -->
            <li class="nav-item {{ Nav::isRoute('home') }}">
                <a class="nav-link" href="{{ route('home') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>{{ __('Dashboard') }}</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                {{ __('Settings') }}
            </div>

        @endif

        @if(Gate::allows('Admin-access'))
            <!-- Nav Item - Users -->
            <li class="nav-item {{ Nav::isRoute('users') }}">
                <a class="nav-link" href="{{ route('users') }}">
                    <i class="fas fa-users"></i>
                    <span>{{ __('Users') }}</span>
                </a>
            </li>
        @endif

        @if(Gate::allows('Admin-access'))
            <!-- Nav Item - Bookings -->
            <li class="nav-item {{ Nav::isRoute('bookings') }}">
                <a class="nav-link" href="{{ route('bookings') }}">
                    <i class="fas fa-bus"></i>
                    <span>{{ __('Rezervime') }}</span>
                </a>
            </li>
        @endif

        @if(Gate::allows('user-access'))
            <!-- Nav Item - Bookings -->
                <li class="nav-item {{ Nav::isRoute('user.bookings') }}">
                    <a class="nav-link" href="{{ route('user.bookings') }}">
                        <i class="fas fa-bus"></i>
                        <span>{{ __('Rezervime') }}</span>
                    </a>
                </li>
        @endif

    @if(Gate::allows('office-access'))
        <!-- Nav Item - Bookings -->
            <li class="nav-item {{ Nav::isRoute('office.bookings') }}">
                <a class="nav-link" href="{{ route('office.bookings') }}">
                    <i class="fas fa-bus"></i>
                    <span>{{ __('Rezervime') }}</span>
                </a>
            </li>
    @endif

        @if(Gate::allows('Admin-access'))
            <!-- Nav Item - Offices -->
            <li class="nav-item {{ Nav::isRoute('offices') }}">
                <a class="nav-link" href="{{ route('offices') }}">
                    <i class="fas fa-building"></i>
                    <span>{{ __('Zyra Shitjesh') }}</span>
                </a>
            </li>
        @endif

        @if(Gate::allows('Admin-access'))
            <!-- Nav Item - Trip -->
            <li class="nav-item {{ Nav::isRoute('trips') }}">
                <a class="nav-link" href="{{ route('trips') }}">
                    <i class="fas fa-road"></i>
                    <span>{{ __('Linjat') }}</span>
                </a>
            </li>
        @endif

    @if(Gate::allows('Admin-access'))
        <!-- Nav Item - Trip -->
            <li class="nav-item {{ Nav::isRoute('intersections') }}">
                <a class="nav-link" href="{{ route('intersections') }}">
                    <i class="fas fa-traffic-light"></i>
                    <span>{{ __('Degezimet') }}</span>
                </a>
            </li>
    @endif

    @if(Gate::allows('Admin-access'))
        <!-- Nav Item - Trip -->
            <li class="nav-item {{ Nav::isRoute('ages') }}">
                <a class="nav-link" href="{{ route('ages') }}">
                    <i class="fas fa-pager"></i>
                    <span>{{ __('Grup Moshat') }}</span>
                </a>
            </li>
    @endif

        <!-- Nav Item - Profile -->
        <li class="nav-item {{ Nav::isRoute('profile') }}">
            <a class="nav-link" href="{{ route('profile') }}">
                <i class="fas fa-fw fa-user"></i>
                <span>{{ __('Profili') }}</span>
            </a>
        </li>

        <!-- Nav Item - About -->
        <li class="nav-item {{ Nav::isRoute('about') }}">
            <a class="nav-link" href="{{ route('about') }}">
                <i class="fas fa-fw fa-hands-helping"></i>
                <span>{{ __('Rreth Nesh') }}</span>
            </a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                @if(Gate::allows('Admin-access'))
                    <!-- Topbar Search -->
                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input id="search-name" type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button onclick="adminGetUser()" class="btn btn-dark" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                @endif

                @if(Gate::allows('office-access'))
                    <!-- Topbar Search -->
                        <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                            <div class="input-group">
                                <input id="search-name" type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button onclick="officeGetUser()" class="btn btn-dark" type="button">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                @endif

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    @if(Gate::allows('Admin-access'))
                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input id="search-name-phone" type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button onclick="adminGetUser()" class="btn btn-dark" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>
                    @endif

                    @if(Gate::allows('office-access'))
                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                            <li class="nav-item dropdown no-arrow d-sm-none">
                                <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-search fa-fw"></i>
                                </a>
                                <!-- Dropdown - Messages -->
                                <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                    <form class="form-inline mr-auto w-100 navbar-search">
                                        <div class="input-group">
                                            <input id="search-name-phone" type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                            <div class="input-group-append">
                                                <button onclick="officeGetUser()" class="btn btn-dark" type="button">
                                                    <i class="fas fa-search fa-sm"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </li>
                    @endif

                    <!-- Nav Item - Alerts -->
                    <li class="nav-item dropdown no-arrow mx-1">
                        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-bell fa-fw"></i>
                            <!-- Counter - Alerts -->
                            <span class="badge badge-danger badge-counter">3+</span>
                        </a>
                        <!-- Dropdown - Alerts -->
                        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                            <h6 class="dropdown-header">
                                Alerts Center
                            </h6>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="mr-3">
                                    <div class="icon-circle bg-dark">
                                        <i class="fas fa-file-alt text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="small text-gray-500">December 12, 2019</div>
                                    <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                </div>
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="mr-3">
                                    <div class="icon-circle bg-success">
                                        <i class="fas fa-donate text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="small text-gray-500">December 7, 2019</div>
                                    $290.29 has been deposited into your account!
                                </div>
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="mr-3">
                                    <div class="icon-circle bg-warning">
                                        <i class="fas fa-exclamation-triangle text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="small text-gray-500">December 2, 2019</div>
                                    Spending Alert: We've noticed unusually high spending for your account.
                                </div>
                            </a>
                            <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                        </div>
                    </li>

                    <!-- Nav Item - Messages -->
                    <li class="nav-item dropdown no-arrow mx-1">
                        <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-envelope fa-fw"></i>
                            <!-- Counter - Messages -->
                            <span class="badge badge-danger badge-counter">7</span>
                        </a>
                        <!-- Dropdown - Messages -->
                        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                            <h6 class="dropdown-header">
                                Message Center
                            </h6>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="dropdown-list-image mr-3">
                                    <img class="rounded-circle" src="https://source.unsplash.com/fn_BT9fwg_E/60x60" alt="">
                                    <div class="status-indicator bg-success"></div>
                                </div>
                                <div class="font-weight-bold">
                                    <div class="text-truncate">Hi there! I am wondering if you can help me with a problem I've been having.</div>
                                    <div class="small text-gray-500">Emily Fowler · 58m</div>
                                </div>
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="dropdown-list-image mr-3">
                                    <img class="rounded-circle" src="https://source.unsplash.com/AU4VPcFN4LE/60x60" alt="">
                                    <div class="status-indicator"></div>
                                </div>
                                <div>
                                    <div class="text-truncate">I have the photos that you ordered last month, how would you like them sent to you?</div>
                                    <div class="small text-gray-500">Jae Chun · 1d</div>
                                </div>
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="dropdown-list-image mr-3">
                                    <img class="rounded-circle" src="https://source.unsplash.com/CS2uCrpNzJY/60x60" alt="">
                                    <div class="status-indicator bg-warning"></div>
                                </div>
                                <div>
                                    <div class="text-truncate">Last month's report looks great, I am very happy with the progress so far, keep up the good work!</div>
                                    <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                                </div>
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="dropdown-list-image mr-3">
                                    <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60" alt="">
                                    <div class="status-indicator bg-success"></div>
                                </div>
                                <div>
                                    <div class="text-truncate">Am I a good boy? The reason I ask is because someone told me that people say this to all dogs, even if they aren't good...</div>
                                    <div class="small text-gray-500">Chicken the Dog · 2w</div>
                                </div>
                            </a>
                            <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                        </div>
                    </li>

                    <div class="topbar-divider d-none d-sm-block"></div>

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                            <figure class="img-profile rounded-circle avatar font-weight-bold" data-initial="{{ Auth::user()->name[0] }}"></figure>
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="{{ route('profile') }}">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                {{ __('Profili') }}
                            </a>
                            @if(Gate::allows('user-access'))
                            <a class="dropdown-item" href="{{ route('user.bookings.create') }}">
                                <i class="fas fa-bus fa-sm fa-fw mr-2 text-gray-400"></i>
                                {{ __('Beni nje Rezervim') }}
                            </a>
                            @endif
                            @if(Gate::allows('office-access'))
                                <a class="dropdown-item" href="{{ route('office.bookings.create') }}">
                                    <i class="fas fa-bus fa-sm fa-fw mr-2 text-gray-400"></i>
                                    {{ __('Beni nje Rezervim') }}
                                </a>
                            @endif
                            @if(Gate::allows('Admin-access'))
                                <a class="dropdown-item" href="{{ route('bookings.create') }}">
                                    <i class="fas fa-bus fa-sm fa-fw mr-2 text-gray-400"></i>
                                    {{ __('Beni nje Rezervim') }}
                                </a>
                            @endif
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                {{ __('Dilni') }}
                            </a>
                        </div>
                    </li>

                </ul>

            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                @yield('main-content')

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy;Likometa 2020</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('Gati te largoheni?') }}</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Zgjidhni opsioni dil per te mbyllur llogarine..</div>
            <div class="modal-footer">
                <button class="btn btn-link" type="button" data-dismiss="modal">{{ __('Anullo') }}</button>
                <a class="btn btn-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Dil') }}</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->

{{-- The search --}}
<script>

    function adminGetUser(){

        var fullname = $("#search-name").val();
        if(fullname == ''){
            fullname = $("#search-name-phone").val();
        }

        $.ajax({
            type:'POST',
            url:'/admin/get/bookings/byname',
            data: {
                "_token": "{{ csrf_token() }}",
                "fullname": fullname,
            },
            success:function(bookings) {
                $('.container-fluid').remove();

                $('#content').append(
                    "<div class=\"container-fluid\">\n" +
                    "        <div class=\"card shadow mb-4\">\n" +
                    "            <div class=\"card-header py-3\">\n" +
                    "                <h6 class=\"m-0 font-weight-bold text-dark\">Perdoruesit</h6>\n" +
                    "            </div>\n" +
                    "            <div class=\"card-body\">\n" +
                    "                <div class=\"table-responsive\">\n" +
                    "                    <table class=\"table table-bordered\" id=\"dataTable\" width=\"100%\" cellspacing=\"0\">\n" +
                    "                        <thead>\n" +
                    "                        <tr>\n" +
                    "                            <th>Nisja</th>\n" +
                    "                            <th>Destinacioni</th>\n" +
                    "                            <th>Data</th>\n" +
                    "                            <th>Orari</th>\n" +
                    "                            <th>Shiko</th>\n" +
                    "                        </tr>\n" +
                    "                        </thead>\n" +
                    "                        <tbody>"
                );

                for(var i=0; i<bookings.length; i++) {

                    var stLoc  = bookings[i].intersection == null ? bookings[i].st_location : bookings[i].intersection;
                    var endLoc = bookings[i].intersection_end == null ? bookings[i].end_location : bookings[i].intersection_end;
                    var stTime = bookings[i].int_time == null ? bookings[i].st_time : bookings[i].int_time;

                    $('tbody').append(
                        "                        <tr>\n" +
                        "                            <td>"+ stLoc +"</td>\n" +
                        "                            <td>"+ endLoc +"</td>\n" +
                        "                            <td>"+ bookings[i].st_date +"</td>\n" +
                        "                            <td>"+ stTime +"</td>\n" +
                        "                            <td style=\"text-align: center;\">\n" +
                        "                                <a href=\"/bookings/" + bookings[i].id + "\" class=\"btn btn-dark btn-circle\">\n" +
                        "                                    <i class=\"fas fa-eye\"></i>\n" +
                        "                                </a>\n" +
                        "                            </td>\n" +
                        "                        </tr>"
                    );

                }

                $('#content').append(
                    "                        </tbody>\n" +
                    "                    </table>\n" +
                    "                </div>\n" +
                    "              </div>\n" +
                    "            </div>\n" +
                    "        </div>"
                );

            },
            error: function(xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    }
    function officeGetUser(){

        var fullname = $("#search-name").val();
        if(fullname == ''){
            fullname = $("#search-name-phone").val();
        }

        $.ajax({
            type:'POST',
            url:'/office/get/bookings/byname',
            data: {
                "_token": "{{ csrf_token() }}",
                "fullname": fullname,
            },
            success:function(bookings) {
                $('.container-fluid').remove();

                $('#content').append(
                    "<div class=\"container-fluid\">\n" +
                    "        <div class=\"card shadow mb-4\">\n" +
                    "            <div class=\"card-header py-3\">\n" +
                    "                <h6 class=\"m-0 font-weight-bold text-dark\">Perdoruesit</h6>\n" +
                    "            </div>\n" +
                    "            <div class=\"card-body\">\n" +
                    "                <div class=\"table-responsive\">\n" +
                    "                    <table class=\"table table-bordered\" id=\"dataTable\" width=\"100%\" cellspacing=\"0\">\n" +
                    "                        <thead>\n" +
                    "                        <tr>\n" +
                    "                            <th>Nisja</th>\n" +
                    "                            <th>Destinacioni</th>\n" +
                    "                            <th>Data</th>\n" +
                    "                            <th>Orari</th>\n" +
                    "                            <th>Shiko</th>\n" +
                    "                        </tr>\n" +
                    "                        </thead>\n" +
                    "                        <tbody>"
                );

                for(var i=0; i<bookings.length; i++) {

                    var stLoc  = bookings[i].intersection == null ? bookings[i].st_location : bookings[i].intersection;
                    var endLoc = bookings[i].intersection_end == null ? bookings[i].end_location : bookings[i].intersection_end;
                    var stTime = bookings[i].int_time == null ? bookings[i].st_time : bookings[i].int_time;

                    $('tbody').append(
                        "                        <tr>\n" +
                        "                            <td>"+ stLoc +"</td>\n" +
                        "                            <td>"+ endLoc +"</td>\n" +
                        "                            <td>"+ bookings[i].st_date +"</td>\n" +
                        "                            <td>"+ stTime +"</td>\n" +
                        "                            <td style=\"text-align: center;\">\n" +
                        "                                <a href=\"/office/bookings/" + bookings[i].id + "\" class=\"btn btn-dark btn-circle\">\n" +
                        "                                    <i class=\"fas fa-eye\"></i>\n" +
                        "                                </a>\n" +
                        "                            </td>\n" +
                        "                        </tr>"
                    );

                }

                $('#content').append(
                    "                        </tbody>\n" +
                    "                    </table>\n" +
                    "                </div>\n" +
                    "              </div>\n" +
                    "            </div>\n" +
                    "        </div>"
                );

            },
            error: function(xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    }

</script>
{{-- End Search --}}

<script src="{{ asset('js/sb-Admin-2.min.js') }}"></script>
</body>
</html>
