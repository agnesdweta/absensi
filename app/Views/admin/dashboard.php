<?= $this->extend('layout/admin'); ?>
<?= $this->section('content'); ?>

<h3>Dashboard</h3>
<p>Selamat datang, <b><?= session()->get('username') ?? 'User'; ?></b></p>

<!-- STATISTIK -->
<div class="row">

    <div class="col-lg-3">
        <div class="small-box bg-primary">
            <div class="inner">
                <h3><?= number_format($total_karyawan ?? 0) ?></h3>
                <p>Total Karyawan</p>
            </div>
            <i class="fas fa-users small-box-icon"></i>
        </div>
    </div>

    <div class="col-lg-3">
        <div class="small-box bg-info">
            <div class="inner">
                <h3><?= number_format($total_cuti ?? 0) ?></h3>
                <p>Total Cuti</p>
            </div>
            <i class="fas fa-calendar small-box-icon"></i>
        </div>
    </div>

    <div class="col-lg-3">
        <div class="small-box bg-success">
            <div class="inner">
                <h3><?= number_format($hadir ?? 0) ?></h3>
                <p>Hadir Hari Ini</p>
            </div>
            <i class="fas fa-user-check small-box-icon"></i>
        </div>
    </div>

    <div class="col-lg-3">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3><?= number_format($tidak_hadir ?? 0) ?></h3>
                <p>Tidak Hadir</p>
            </div>
            <i class="fas fa-user-times small-box-icon"></i>
        </div>
    </div>

</div>

<!-- GRAFIK BULANAN -->
<div class="card">
    <div class="card-header">
        <h5>Grafik Cuti Bulanan</h5>
    </div>
    <div class="card-body">
        <canvas id="chartBulanan"></canvas>
    </div>
</div>

<!-- LOG -->
<div class="card mt-3">
    <div class="card-header">
        <h5>Log Aktivitas</h5>
    </div>
    <div class="card-body">

        <ul class="list-group">
            <?php if(!empty($log)): ?>
                <?php foreach($log as $l): ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span><?= $l['aktivitas'] ?></span>
                        <small class="text-muted">
                            <?= date('d-m-Y H:i', strtotime($l['created_at'])) ?>
                        </small>
                    </li>
                <?php endforeach; ?>
            <?php else: ?>
                <li class="list-group-item text-center text-muted">
                    Tidak ada aktivitas
                </li>
            <?php endif; ?>
        </ul>

    </div>
</div>

<!-- CHART -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
new Chart(document.getElementById('chartBulanan'), {
    type: 'line',
    data: {
        labels: <?= $bulan ?? '[]' ?>,
        datasets: [{
            label: 'Cuti per Bulan',
            data: <?= $jumlah ?? '[]' ?>,
            fill: true,
            tension: 0.4
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: true
            }
        }
    }
});
</script>

<?= $this->endSection(); ?>