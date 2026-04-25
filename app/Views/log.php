<?= $this->extend('layout/admin'); ?>
<?= $this->section('content'); ?>

<h3>Log Aktivitas</h3>

<table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>User</th>
        <th>Aksi</th>
        <th>Aktivitas</th>
        <th>Waktu</th>
    </tr>

    <?php $no=1; foreach($log as $l): ?>
    <tr>
        <td><?= $no++ ?></td>
        <td><?= $l['user'] ?></td>

        <td>
            <?php if($l['aksi']=='create'): ?>
                <span class="badge badge-primary">Create</span>
            <?php elseif($l['aksi']=='update'): ?>
                <span class="badge badge-warning">Update</span>
            <?php elseif($l['aksi']=='delete'): ?>
                <span class="badge badge-danger">Delete</span>
            <?php elseif($l['aksi']=='approve'): ?>
                <span class="badge badge-success">Approve</span>
            <?php else: ?>
                <span class="badge badge-secondary">Reject</span>
            <?php endif; ?>
        </td>

        <td><?= $l['aktivitas'] ?></td>

        <td>
            <?= date('d-m-Y H:i', strtotime($l['created_at'])) ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<?= $this->endSection(); ?>