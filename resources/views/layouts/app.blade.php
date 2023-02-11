<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/content.css') }}" rel="stylesheet">
</head>

<body>
    <div class="header">
        <div class="container">
            <div class="row py-2">
                <div class="col-12 col-sm-4 col-md-4 col-lg-3 d-flex align-items-center logo">
                    <h3>My Website</h3>
                </div>
                <div class="col-12 col-md-8 col-lg-9 row justify-content-between mx-auto">
                    <div class="form-group searchfild w-75 m-0 d-flex align-items-center">
                        <div class="form-group m-0 w-100">
                            <form action="{{ url('results') }}" method="post" id="searchform">
                                @csrf
                                <input type="search" name="search_query" id="search" class="form-control m-0"
                                    placeholder="Type to Search" value="@php if(isset($req)){echo $req; } @endphp">
                                <button type="submit" id="btnsearch"><i class="bi bi-search"></i></button>
                            </form>
                        </div>
                    </div>
                    <div class="wlc_admin w-25">
                        <button class="wadropbtn">
                            <i class="bi bi-person-fill" style="
                        font-size: 1.5rem;"></i>
                            <h6 class="m-0">Hi, {{ session('logedadmin') }}</h6>
                        </button>
                        <div class="wadropdown-content">
                            @php
                            @endphp
                            <a class="dropdown-item" href="{{ url('my-profile') }}">
                                <i class="bi bi-person-fill"></i><span>Profile</span>
                            </a>
                            <a class="dropdown-item" href="{{ url('logout') }}">
                                <i class="bi bi-power"></i><span>Log Out</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @php
        $ar = Session('logedadminrole');
        if ($ar == 2 or $ar == 3) {
            $pm = Session('permissions');
        }
    @endphp
    <div id="main">
        <div id="sidebar">
            <ul id="sbmenu">
                <li><a href="{{ url('home') }}"><i class="bi bi-grid-fill"></i><span>Home</span></a></li>
                <li>
                    <button class="menu_dropd_btn"><i class="bi bi-file-earmark-fill"></i> <span>Files <i
                                class="bi bi-chevron-down" style="margin-left: 60%;"></i></span></button>
                    <div class="menu_dropd_content">
                        <ul>
                            <li><a href="{{ url('file') }}"><i class="bi bi-file-earmark-arrow-down-fill"></i><span>All Files</span></a></li>
                            <li><a href="{{ url('fileup') }}"><i class="bi bi-file-earmark-arrow-up-fill"></i><span>Add File</span></a></li>
                        </ul>
                    </div>
                </li>
                <li><a href="{{ url('admins') }}"><i class="bi bi-person-fill-gear"></i><span>Admins</span></a></li>
                <li><a href="{{ url('category') }}"><i class="bi bi-diagram-3-fill"></i><span>Category</span></a></li>
                <li><a href="{{ url('sub-category') }}"><i class="bi bi-diagram-2-fill"></i><span>Sub
                            Category</span></a></li>
                <li><a href="{{ url('my-profile') }}"><i class="bi bi-person-fill"></i><span>My Profile</span></a></li>
                @if (Session('logedadminrole') == 1)
                    <li><a href="{{ url('permission') }}"><i class="bi bi-gear-fill"></i><span>Permission
                                Setting</span></a></li>
                @endif
                <li>
                    <a class="dropdown-item" href="{{ url('logout') }}"><i class="bi bi-power"></i><span>Log
                            Out</span></a>
                </li>
            </ul>
            <button id="slide-nav"><i class="bi bi-chevron-left"></i></button>
        </div>
        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script>
        var sidebar = document.getElementById("sidebar");
        var contentbx = document.getElementById("content");
        var sidebarsta = sessionStorage.getItem("sidebarsess");
        if (sidebarsta == 'hide') {
            sidebar.classList.add("hide");
            contentbx.classList.add("lg");
        }
        document.getElementById("slide-nav").addEventListener("click", function() {
            let sidebarst = sessionStorage.getItem("sidebarsess");
            if (sidebarst == 'hide') {
                sessionStorage.removeItem("sidebarsess");
                sidebar.classList.remove("hide");
                contentbx.classList.remove("lg");
            } else {
                sessionStorage.setItem("sidebarsess", "hide");
                sidebar.classList.add("hide");
                contentbx.classList.add("lg");
            }
        })
    </script>
    @yield('script')
</body>

</html>
