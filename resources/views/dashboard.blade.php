<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>School Management Dashboard</title>
    <!-- Theme CSS with CDN fallback -->
    <link rel="stylesheet" href="{{ asset('vendors/mdi/css/materialdesignicons.min.css') }}" onerror="this.href='https://cdn.materialdesignicons.com/5.3.45/css/materialdesignicons.min.css'">
    <link rel="stylesheet" href="{{ asset('vendors/base/vendor.bundle.base.css') }}" onerror="this.href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css'">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" onerror="this.onerror=null; this.href='https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css'">
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" onerror="this.href='https://via.placeholder.com/16'">
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
            background-color: #00ff00;
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
                <a class="navbar-brand brand-logo" href="#"><img src="{{ asset('images/logo.svg') }}" alt="logo" /></a>
                <a class="navbar-brand brand-logo-mini" href="#"><img src="{{ asset('images/logo-mini.svg') }}" alt="logo" /></a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-stretch">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="mdi mdi-menu"></span>
                </button>
                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown" aria-expanded="false">
                            <img src="{{ asset('images/logo.svg') }}" alt="profile" style="width: 30px; height: 30px; border-radius: 50%;" />
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
        <!-- Sidebar -->
        <div class="container-fluid page-body-wrapper">
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#" id="dashboardLink">
                            <i class="mdi mdi-home menu-icon"></i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" id="usersLink">
                            <i class="mdi mdi-account menu-icon"></i>
                            <span class="menu-title">Users</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- Main Content -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <!-- Overview Header -->
                    <div class="row overview-header" id="overviewHeader">
                        <div class="col-md-12 grid-margin">
                            <div class="d-flex justify-content-between flex-wrap">
                                <div class="d-flex align-items-end flex-wrap">
                                    <div class="me-md-3 me-xl-5">
                                        <h2>Dashboard Overview</h2>
                                        <p class="mb-md-0">Current Time: {{ now()->format('h:i A IST, d F Y') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Form Title -->
                    <div class="row form-title" id="formTitle" style="display: none;">
                        <div class="col-md-12 grid-margin">
                            <div class="d-flex justify-content-between flex-wrap">
                                <div class="d-flex align-items-end flex-wrap">
                                    <div class="me-md-3 me-xl-5">
                                        <h2 id="dynamicTitle">Update Profile</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Dashboard Content -->
                    <div class="row dashboard-content" id="dashboardContent">
                        <div class="col-md-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Orders Chart</h4>
                                    <canvas id="order-chart"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Sales Chart</h4>
                                    <canvas id="sales-chart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- User Info -->
                    <div class="user-info" id="userInfo">
                        <!-- <div class="me-md-3 me-xl-5">
                            <h2>Users List</h2>
                        </div> -->
                        <span><strong>Name:</strong> {{ auth()->user()->first_name ?? 'User' }} {{ auth()->user()->last_name ?? '' }}</span>
                        <span><strong>Email:</strong> {{ auth()->user()->email ?? 'N/A' }}</span>
                        <a href="#" class="btn btn-primary add-user-btn" id="addUserBtn">Add User</a>
                    </div>
                    <!-- Dynamic Form Container -->
                    <div id="dynamicFormContainer"></div>
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif
                </div>
                <!-- Footer -->
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © {{ now()->format('Y') }}</span>
                    </div>
                </footer>
            </div>
        </div>
    </div>
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('vendors/base/vendor.bundle.base.js') }}" onerror="this.onerror=null;"></script>
    <script src="{{ asset('assets/js/off-canvas.js') }}" onerror="this.onerror=null;"></script>
    <script src="{{ asset('assets/js/hoverable-collapse.js') }}" onerror="this.onerror=null;"></script>
    <script src="{{ asset('assets/js/template.js') }}" onerror="this.onerror=null;"></script>

    <script>
        const overviewHeader = document.getElementById('overviewHeader');
        const formTitle = document.getElementById('formTitle');
        const dashboardContent = document.getElementById('dashboardContent');
        const userInfo = document.getElementById('userInfo');
        const dynamicFormContainer = document.getElementById('dynamicFormContainer');
        const sidebarLinks = document.querySelectorAll('.nav-link');

        // Initial state
        overviewHeader.classList.remove('hidden');
        formTitle.classList.add('hidden');
        dashboardContent.classList.add('show');
        userInfo.style.display = 'none';
        dynamicFormContainer.style.display = 'none';

        // Toggle Dashboard
        document.getElementById('dashboardLink').addEventListener('click', function(e) {
            e.preventDefault();
            overviewHeader.classList.remove('hidden');
            formTitle.classList.add('hidden');
            dashboardContent.classList.add('show');
            userInfo.style.display = 'none';
            dynamicFormContainer.style.display = 'none';
            setActiveLink('dashboardLink');
        });

        // Toggle Users
        document.getElementById('usersLink').addEventListener('click', function(e) {
            e.preventDefault();
            overviewHeader.classList.add('hidden');
            formTitle.classList.add('hidden');
            dashboardContent.classList.remove('show');
            userInfo.style.display = 'flex';
            dynamicFormContainer.style.display = 'none';
            setActiveLink('usersLink');
        });

        // Load Update Profile Form
        document.getElementById('updateProfileBtn').addEventListener('click', function(e) {
            e.preventDefault();
            console.log('Loading Update Profile form');
            loadForm('/profile/edit', 'Update Profile');
        });

        // Load Add User Form
        document.getElementById('addUserBtn').addEventListener('click', function(e) {
            e.preventDefault();
            console.log('Loading Add User form');
            loadForm('/user/create', 'Add User');
        });

        // AJAX Function to Load Form
        function loadForm(url, title) {
            console.log('Fetching form from:', url);
            fetch(url)
                .then(response => {
                    console.log('Form fetch response status:', response.status);
                    return response.text();
                })
                .then(html => {
                    overviewHeader.classList.add('hidden');
                    formTitle.classList.remove('hidden');
                    document.getElementById('dynamicTitle').textContent = title;
                    dynamicFormContainer.innerHTML = html;
                    dynamicFormContainer.style.display = 'block';
                    dashboardContent.classList.remove('show');
                    userInfo.style.display = 'none';
                    // Reattach submit handler
                    const form = dynamicFormContainer.querySelector('#profileForm, #addUserForm');
                    if (form) {
                        console.log('Form loaded, attaching submit event to:', form.id);
                        form.addEventListener('submit', function(e) {
                            e.preventDefault();
                            submitForm(this);
                        });
                    }
                    const cancelBtn = dynamicFormContainer.querySelector('.btn-secondary');
                    if (cancelBtn) {
                        cancelBtn.addEventListener('click', function() {
                            overviewHeader.classList.remove('hidden');
                            formTitle.classList.add('hidden');
                            dynamicFormContainer.style.display = 'none';
                            dashboardContent.classList.add('show');
                        });
                    }
                })
                .catch(error => console.error('Error loading form:', error));
        }

        // AJAX Form Submit
        function submitForm(form) {
            console.log('Submitting form:', form.action, 'Method:', form.method);
            const formData = new FormData(form);
            // Log form data for debugging
            for (let pair of formData.entries()) {
                console.log(pair[0] + ': ' + pair[1]);
            }
            fetch(form.action, {
                    method: form.method || 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                })
                // .then(response => {
                //     console.log('Server response status:', response.status);
                //     console.log('Raw response text:', response.text());
                //     if (!response.ok) throw new Error('Network response was not ok ' + response.statusText);
                //     return response.json();
                // })
                // .then(data => {
                //     console.log('Server response data:', data);
                //     if (data.status === 'success') {
                //         alert(data.message);
                //         overviewHeader.classList.remove('hidden');
                //         formTitle.classList.add('hidden');
                //         dynamicFormContainer.style.display = 'none';
                //         dashboardContent.classList.add('show');
                //     } else {
                //         alert('Error: ' + data.message);
                //     }
                // })


                .then(response => {
                    console.log('Server response status:', response.status);
                    // Check if response is OK and attempt to parse as JSON first
                    if (!response.ok) {
                        return response.text().then(text => Promise.reject(new Error('Server error: ' + text)));
                    }
                    // Clone the response to read it multiple times if needed
                    const responseClone = response.clone();
                    return responseClone.json().catch(() => responseClone.text().then(text => {
                        return {
                            status: 'error',
                            message: 'Invalid JSON response: ' + text.substring(0, 100) + '...'
                        };
                    }));
                })
                .then(data => {
                    console.log('Server response data:', data);
                    if (data.status === 'success') {
                        alert(data.message);
                        overviewHeader.classList.remove('hidden');
                        formTitle.classList.add('hidden');
                        dynamicFormContainer.style.display = 'none';
                        dashboardContent.classList.add('show');
                    } else {
                        alert('Error: ' + data.message);
                    }
                })
                .catch(error => console.error('Error submitting form:', error));
            // Fallback to check if response is HTML
            response.text().then(text => console.log('HTML fallback:', text));
        }

        // Set active link in sidebar
        function setActiveLink(activeId) {
            sidebarLinks.forEach(link => link.classList.remove('active'));
            document.getElementById(activeId).classList.add('active');
        }

        // Set initial active link
        window.onload = function() {
            setActiveLink('dashboardLink');
        };
    </script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('assets/js/dashboard.js') }}" defer onerror="this.onerror=null;"></script>
</body>

</html>