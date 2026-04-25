<?= $this->extend('layout/admin'); ?>
<?= $this->section('content'); ?>

<h3>Edit Absensi</h3>

<form action="<?= base_url('absensi/update/'.$absensi['id']) ?>" method="post">

    <div class="form-group">
        <label>Nama Karyawan</label>
        <input type="text" name="nama_karyawan" 
               value="<?= $absensi['nama_karyawan'] ?>" 
               class="form-control" required>
    </div>

    <div class="form-group">
        <label>Tanggal</label>
        <input type="date" name="tanggal" 
               value="<?= $absensi['tanggal'] ?>" 
               class="form-control" required>
    </div>

    <div class="form-group">
        <label>Status</label>
        <select name="status" class="form-control">
            <option value="hadir" <?= $absensi['status']=='hadir' ? 'selected' : '' ?>>Hadir</option>
            <option value="tidak_hadir" <?= $absensi['status']=='tidak_hadir' ? 'selected' : '' ?>>Tidak Hadir</option>
        </select>
    </div>

    <button class="btn btn-success">Update</button>
    <a href="<?= base_url('absensi') ?>" class="btn btn-secondary">Kembali</a>

</form>

<?= $this->endSection(); ?>