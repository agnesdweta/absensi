<?= $this->extend('layout/admin'); ?>
<?= $this->section('content'); ?>

<h3>Ajukan Cuti</h3>

<form action="<?= base_url('cuti/store') ?>" method="post">

    <div class="form-group">
        <label>Nama</label>
        <input type="text" value="<?= session()->get('username') ?>" class="form-control" readonly>
    </div>

    <div class="form-group">
        <label>Tanggal Mulai</label>
        <input type="date" name="tanggal_mulai" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Tanggal Selesai</label>
        <input type="date" name="tanggal_selesai" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Keterangan</label>
        <textarea name="keterangan" class="form-control"></textarea>
    </div>

    <button class="btn btn-success">Ajukan</button>
    <a href="<?= base_url('cuti') ?>" class="btn btn-secondary">Kembali</a>

</form>

<?= $this->endSection(); ?>