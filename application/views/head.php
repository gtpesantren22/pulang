<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>App Absensi Pulang - DWK22</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?= base_url() ?>dash/vendors/feather/feather.css">
    <link rel="stylesheet" href="<?= base_url() ?>dash/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="<?= base_url() ?>dash/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="<?= base_url() ?>dash/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="<?= base_url() ?>dash/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" type="text/css" href="js/select.dataTables.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="<?= base_url() ?>dash/css/vertical-layout-light/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="<?= base_url() ?>dash/images/favicon.png" />
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo mr-5" href="<?= base_url() ?>">App Pulangan</a>
                <a class="navbar-brand brand-logo-mini" href="<?= base_url() ?>"><img src="<?= base_url() ?>dash/images/logo-mini.svg" alt="logo"></a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="icon-menu"></span>
                </button>
                <ul class="navbar-nav mr-lg-2">
                    <li class="nav-item nav-search d-none d-lg-block">
                        <div class="input-group">
                            <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
                                <span class="input-group-text" id="search">
                                    <i class="icon-search"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" id="navbar-search-input" placeholder="Search now" aria-label="search" aria-describedby="search">
                        </div>
                    </li>
                </ul>
                <ul class="navbar-nav navbar-nav-right">

                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                            <img src="<?= base_url() ?>dash/images/faces/face28.jpg" alt="profile">
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                            <a class="dropdown-item">
                                <i class="ti-settings text-primary"></i>
                                Settings
                            </a>
                            <a class="dropdown-item" href="<?= base_url('welcome/logout') ?>">
                                <i class="ti-power-off text-primary"></i>
                                Logout
                            </a>
                        </div>
                    </li>
                    <li class="nav-item nav-profile">
                        <span>Admin App</span>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                    <span class="icon-menu"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial -->
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link " href="<?= base_url(); ?>">
                            <i class="icon-grid menu-icon"></i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                            <i class="icon-layout menu-icon"></i>
                            <span class="menu-title">Daftar Santri</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="ui-basic">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="<?= base_url(); ?>santri">Santri Putra</a></li>
                                <li class="nav-item"> <a class="nav-link" href="<?= base_url(); ?>santri/pi">Santri Putri</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item <?= $title === 'surat' ? 'active' : '' ?>">
                        <a class="nav-link" href="<?= base_url(); ?>surat">
                            <i class="icon-paper menu-icon"></i>
                            <span class="menu-title">Pengambilan Surat</span>
                        </a>
                    </li>
                    <li class="nav-item <?= $title === 'pulang' ? 'active' : '' ?>">
                        <a class="nav-link" href="<?= base_url('pulang'); ?>">
                            <!--<a class="nav-link" href="#">-->
                            <i class="icon-paper menu-icon"></i>
                            <span class="menu-title">Absensi Pulang</span>
                        </a>
                    </li>
                    <li class="nav-item <?= $title === 'kembali' ? 'active' : '' ?>">
                        <a class="nav-link" href="<?= base_url('kembali'); ?>">
                            <!--<a class="nav-link" href="#">-->
                            <i class="icon-paper menu-icon"></i>
                            <span class="menu-title">Absensi Kembali</span>
                        </a>
                    </li>
                    <li class="nav-item <?= $title === 'rekap' ? 'active' : '' ?>">
                        <!-- <a class="nav-link" href="<?= base_url('kembali'); ?>"> -->
                        <a class="nav-link" href="<?= base_url('rekap'); ?>">
                            <i class="mdi mdi-animation menu-icon"></i>
                            <span class="menu-title">Rekapan</span>
                        </a>
                    </li>
                </ul>
            </nav>