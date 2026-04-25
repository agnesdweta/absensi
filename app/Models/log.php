<?= $this->extend('layout/admin'); ?>
<?= $this->section('content'); ?>

<h3>Log Aktivitas</h3>

<table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Aktivitas</th>
        <th>Waktu</th>
    </tr>

    <?php $no=1; foreach($log as $l): ?>
    <tr>
        <td><?= $no++ ?></td>
        <td><?= $l['aktivitas'] ?></td>
        <td><?= $l['created_at'] ?></td>
    </tr>
    <?php endforeach; ?>
</table>

<?= $this->endSection(); ?>