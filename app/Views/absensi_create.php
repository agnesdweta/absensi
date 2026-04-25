<?= $this->extend('layout/admin'); ?>
<?= $this->section('content'); ?>

<h3>Tambah Absensi</h3>

<form action="<?= base_url('absensi/store') ?>" method="post">

    <div class="form-group">
        <label>Nama Karyawan</label>
        <input type="text" name="nama_karyawan" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Tanggal</label>
        <input type="date" name="tanggal" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Status</label>
        <select name="status" class="form-control">
            <option value="hadir">Hadir</option>
            <option value="tidak_hadir">Tidak Hadir</option>
        </select>
    </div>

    <button class="btn btn-success">Simpan</button>
</form>

<?= $this->endSection(); ?>