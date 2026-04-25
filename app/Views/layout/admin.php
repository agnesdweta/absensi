<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Dashboard Absensi</title>

    <!-- AdminLTE + Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body class="hold-transition sidebar-mini">

<div class="wrapper">

    <!-- NAVBAR -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#">
                    <i class="fas fa-bars"></i>
                </a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
            <li class="nav-item mr-3">
                <span class="text-dark">
                    👤 <?= session()->get('username') ?? 'User'; ?>
                </span>
            </li>

            <li class="nav-item">
                <a href="<?= base_url('logout') ?>" class="btn btn-danger btn-sm">
                    Logout
                </a>
            </li>
        </ul>
    </nav>

    <!-- SIDEBAR -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">

        <a href="#" class="brand-link text-center">
            <span class="brand-text font-weight-light">ABSENSI APP</span>
        </a>

        <div class="sidebar">

            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column">

                    <!-- Dashboard -->
                    <li class="nav-item">
                        <a href="<?= base_url('dashboard') ?>" 
                           class="nav-link <?= uri_string() == 'dashboard' ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-home"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <?php if(session()->get('role') == 'admin'): ?>

                    <!-- Karyawan (ADMIN SAJA) -->
        <li class="nav-item">
            <a href="<?= base_url('karyawan') ?>" 
               class="nav-link <?= uri_string() == 'karyawan' ? 'active' : '' ?>">
                <i class="nav-icon fas fa-users"></i>
                <p>Karyawan</p>
            </a>
        </li>

    <?php endif; ?>

    <!-- Absensi (SEMUA ROLE) -->
    <li class="nav-item">
        <a href="<?= base_url('absensi') ?>" 
           class="nav-link <?= uri_string() == 'absensi' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-clock"></i>
            <p>Absensi</p>
        </a>
    </li>

    <!-- Cuti (SEMUA ROLE) -->
    <li class="nav-item">
        <a href="<?= base_url('cuti') ?>" 
           class="nav-link <?= uri_string() == 'cuti' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-calendar"></i>
            <p>Data Cuti</p>
        </a>
    </li>
    <!-- Log (ADMIN SAJA) -->
        <li class="nav-item">
            <a href="<?= base_url('log') ?>" 
               class="nav-link <?= uri_string() == 'log' ? 'active' : '' ?>">
                <i class="nav-icon fas fa-history"></i>
                <p>Log Aktivitas</p>
            </a>
        </li>

</ul>

            </nav>

        </div>
    </aside>

    <!-- CONTENT -->
    <div class="content-wrapper p-3">
        <?= $this->renderSection('content'); ?>
    </div>

</div>

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

</body>
</html>