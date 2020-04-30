<nav class="navbar navbar-expand-lg navbar-dark bg-dark navbar-fixed-top" role="navigation">

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
        <a class="navbar-brand" href="/admin">Admin</a>
        <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item"><a class="nav-link" href="/">HOME</a></li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i> WhatUWant</a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="profile"><i class="fa fa-fw fa-gear"></i> Settings</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="../includes/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                </div>
            </li>
        </ul>
    </div>
</nav>

<div class="container-fluid">
    <div class="row min-vh-100">
        <div class="col-2 p-0 bg-dark">
            <nav class="navbar navbar-expand navbar-dark bg-dark flex-md-column flex-row align-items-start py-2">
                <div class="collapse navbar-collapse ">
                    <ul class="flex-md-column flex-row navbar-nav w-100 justify-content-between">
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pl-0" href="/admin"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link pl-0 dropdown-toggle" data-toggle="dropdown" id="navbarDropdown01" href="#"><i class="fas fa-paste"></i> Posts</a>
                            <div class="nav-item" aria-labelledby="navbarDropdown">
                                <a class="nav-link" href="/admin/posts"><i class="far fa-clone"></i> View All Posts</a>
                                <a class="nav-link" href="/admin/posts/add_post"><i class="far fa-clipboard"></i> Add Posts</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pl-0" href="/admin/categories"><i class="fa fa-fw fa-wrench"></i> Categories Grid</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pl-0" href="/admin/comments"><i class="fa fa-fw fa-file"></i> Comments </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pl-0" href="/admin/profile"><i class="fa fa-user"></i> Profile</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <div class="col-10 bg-faded py-3 flex-grow-1">
