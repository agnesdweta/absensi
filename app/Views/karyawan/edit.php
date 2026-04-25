<?= $this->extend('layout/admin'); ?>
<?= $this->section('content'); ?>

<div class="card">
    <div class="card-body">

        <form method="post" action="<?= base_url('karyawan/update/'.$karyawan['id']) ?>">

            <input type="text" name="nama" value="<?= $karyawan['nama'] ?>" class="form-control mb-2">

            <input type="text" name="jabatan" value="<?= $karyawan['jabatan'] ?>" class="form-control mb-2">

            <input type="text" name="telp" value="<?= $karyawan['telp'] ?>" class="form-control mb-2">

            <button class="btn btn-primary">Update</button>

        </form>

    </div>
</div>

<?= $this->endSection(); ?>