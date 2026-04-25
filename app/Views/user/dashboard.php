<?= $this->extend('layout/admin'); ?>
<?= $this->section('content'); ?>

<h3>Dashboard Karyawan</h3>
<p>Selamat datang, <b><?= session()->get('username'); ?></b></p>

<!-- QUICK ACTION -->
<div class="row mb-3">

    <div class="col-md-6">
        <a href="<?= base_url('absensi/create') ?>" class="btn btn-success btn-block">
            <i class="fas fa-clock"></i> Absen Sekarang
        </a>
    </div>

    <div class="col-md-6">
        <a href="<?= base_url('cuti') ?>" class="btn btn-warning btn-block">
            <i class="fas fa-calendar-plus"></i> Ajukan Cuti
        </a>
    </div>

</div>

<!-- STATISTIK -->
<div class="row">

    <div class="col-md-4">
        <div class="card bg-primary text-white">
            <div class="card-body text-center">
                <h4><?= $total_cuti ?? 0 ?></h4>
                <p>Total Cuti Saya</p>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card bg-warning text-white">
            <div class="card-body text-center">
                <h4><?= $pending ?? 0 ?></h4>
                <p>Cuti Pending</p>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card bg-success text-white">
            <div class="card-body text-center">
                <h4><?= $hadir ?? 0 ?></h4>
                <p>Hadir Hari Ini</p>
            </div>
        </div>
    </div>

</div>

<!-- INFO -->
<div class="card mt-4">
    <div class="card-header">
        <h5>Informasi</h5>
    </div>
    <div class="card-body">
        <p>✔ Lakukan absensi setiap hari</p>
        <p>✔ Ajukan cuti jika diperlukan</p>
        <p>✔ Pastikan data kehadiran selalu lengkap</p>
    </div>
</div>

<?= $this->endSection(); ?>