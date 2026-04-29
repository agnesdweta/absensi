<?= $this->extend('layout/user'); ?>
<?= $this->section('content'); ?>

<h3>Absen Sekarang</h3>

<form action="<?= base_url('absensi/store') ?>" method="post">
    <?= csrf_field() ?>

    <div class="form-group">
        <label>Nama</label>
        <input type="text" class="form-control"
               value="<?= session()->get('username') ?>" readonly>
    </div>

    <div class="form-group">
        <label>Tanggal</label>
        <input type="date" class="form-control"
               value="<?= date('Y-m-d') ?>" readonly>
    </div>

    <div class="form-group">
        <label>Status</label>
        <input type="text" class="form-control"
               value="Hadir" readonly>
    </div>

    <button type="submit" class="btn btn-success">
    Absen Sekarang
</button>

    <a href="<?= base_url('absensi') ?>" class="btn btn-secondary">
        Kembali
    </a>

</form>

<?= $this->endSection(); ?>