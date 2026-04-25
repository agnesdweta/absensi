<?= $this->extend('layout/admin'); ?>
<?= $this->section('content'); ?>

<div class="card">
    <div class="card-body">

        <form method="post" action="<?= base_url('karyawan/store') ?>">

            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="nama" class="form-control">
            </div>

            <div class="form-group">
                <label>Jabatan</label>
                <input type="text" name="jabatan" class="form-control">
            </div>

            <div class="form-group">
                <label>Telp</label>
                <input type="text" name="telp" class="form-control">
            </div>

            <button class="btn btn-success">Simpan</button>

        </form>

    </div>
</div>

<?= $this->endSection(); ?>