<?php

include('connect.php');


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
    <link rel="stylesheet" href="dashboard_style.css">
</head>
<body>

    <div class="wrapper">
        <aside id="sidebar" class="d-lg-block d-none">
            <div class="h-100">
                <div class="sidebar-logo">
                    <a href="https://coresystech.ng/contactus.html"><img src="img/logo.png" style="width: 10rem !important;" alt="CORE-TECH"></a>
                </div>
                <ul class="sidebar-nav">
                    <li class="mt-3">
                        <a href="#" class="sidebar-link">
                            <i class="fa-solid fa-list"></i>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#pages" data-bs-toggle="collapse" aria-expanded="false">
                            <i class="fa-solid fa-file-lines"></i>
                            Files
                        </a>
                    </li>
                </ul>
            </div>
        </aside>
        <div class="main bg-light">
            <nav class="navbar navbar-expand border-bottom px-4">
                <button class="btn d-lg-block d-none" id="sidebar-toggle" type="button">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="d-flex gap-3 d-lg-none">
                    <i class="fa-solid fa-house fs-2"></i>
                    <i class="fa-solid fa-file-lines fs-2"></i>
                </div>
                <div class="navbar-collapse navbar">
                    <ul class="navbar-nav">
                        <div class="d-flex bg rounded-pill p-1 align-items-center" data-bs-toggle="dropdown" style="cursor: pointer;">
                            <p class="px-2 mb-0">Welcome, Collins</p>
                            <li class="nav-item dropdown mb-0">
                                <a href="#" class="nav-icon pe-md-0">
                                    <img src="img/avatar.jpg" class="avatar img-fluid rounded-pill" alt="">
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a href="#" class="dropdown-item"><i class="fa-solid fa-user fs-5 pe-1"></i>Profile</a>
                                    <a href="#" class="dropdown-item"><i class="fa-solid fa-gear fs-5 pe-1"></i>Settings</a>
                                    <a href="#" class="dropdown-item"><i class="fa-solid fa-right-from-bracket fs-5 text-danger"></i> Logout</a>
                                </div>
                            </li>
                        </div>
                    </ul>
                </div>
            </nav>
            <main class="content px-3 py-2">
                <div class="container-fluid">
                    <div class="mb-3">
                        <h4>Admin Dashboard</h4>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <a href="" style="text-decoration: none">
                                <div class="card special-effects border-0 text-white bg-primary h-100">
                                    <div class="card-body">
                                        <h5 class="card-title">Active Students</h5>
                                        <p class="card-text fs-1 text-end">35</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4 mb-3">
                            <a href="" style="text-decoration: none">
                                <div class="card special-effects border-0 text-white bg-success h-100">
                                    <div class="card-body">
                                        <h5 class="card-title">Total Courses</h5>
                                        <p class="card-text fs-1 text-end">12</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4 mb-3">
                            <a href="" style="text-decoration: none">
                                <div class="card special-effects border-0 text-white bg-warning h-100">
                                    <div class="card-body">
                                        <h5 class="card-title">Pending Registrations</h5>
                                        <p class="card-text fs-1 text-end">7</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<script src="script.js" ></script>
</body>
</html>