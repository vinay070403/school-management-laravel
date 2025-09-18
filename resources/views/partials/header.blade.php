<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>School Management Dashboard</title>
    <!-- Theme CSS with CDN fallback -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}" onerror="this.href='https://cdn.materialdesignicons.com/5.3.45/css/materialdesignicons.min.css'">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" onerror="this.onerror=null; this.href='https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css'">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" onerror="this.href='https://via.placeholder.com/16'">
    <style>
        .overview-header {
            display: block;
        }

        .overview-header.hidden {
            display: none;
        }

        #dynamicFormContainer {
            display: none;
            margin-top: 20px;
        }

        #dynamicFormContainer.show {
            display: block;
        }

        .form-title {
            display: none;
        }

        .form-title.show {
            display: block;
        }

        .user-info {
            display: none;
            margin-top: 20px;
            padding: 10px;
            background-color: #f8f9fa;
            border-radius: 5px;
            align-items: center;
            gap: 20px;
        }

        .user-info.show {
            display: flex;
        }

        .add-user-btn {
            margin-left: auto;
        }

        .dashboard-content {
            display: none;
        }

        .dashboard-content.show {
            display: flex;
        }

        /* Sidebar clickable styles */
        .nav-link {
            transition: background-color 0.3s, color 0.3s;
        }

        .nav-link:hover {
            background-color: #e9ecef;
            color: #007bff;
        }

        .nav-link.active {
            background-color: #e9ecef;
            color: #fff;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <div class="container-scroller">
        <!-- Header/Navbar -->
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo" href="#"><img src="{{ asset('assets/images/logo1.svg') }}" alt="logo" /></a>
                <a class="navbar-brand brand-logo-mini" href="#"><img src="{{ asset('assets/images/logo-mini.svg') }}" alt="logo" /></a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-stretch">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="mdi mdi-menu"></span>
                </button>
                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown" aria-expanded="false">
                            <img src="{{ asset('assets/images/logo.svg') }}" alt="profile" style="width: 30px; height: 30px; border-radius: 50%;" />
                            <span class="nav-profile-name">Profile</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                            <li><a class="dropdown-item" href="#" id="updateProfileBtn">Update Profile</a></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                    <span class="mdi mdi-menu"></span>
                </button>
            </div>
        </nav>