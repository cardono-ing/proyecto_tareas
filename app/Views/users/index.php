<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<h2><?= lang('Users.title') ?></h2>
<a class="btn btn-primary mb-3" href="/users/new"><?= lang('Users.new') ?></a>
<table class="table table-striped">
    <thead><tr>
        <th><?= lang('Auth.name') ?></th><th><?= lang('Auth.email') ?></th>
        <th><?= lang('Users.active') ?></th><th><?= lang('Users.admin') ?></th>
        <th><?= lang('Users.created_at') ?></th>
    </tr></thead>
    <tbody>
    <?php foreach ($users as $u): ?>
        <tr>
            <td><a href="/users/<?= (int) $u['id'] ?>"><?= esc($u['name']) ?></a></td>
            <td><?= esc($u['email']) ?></td>
            <td><?= $u['active'] ? lang('Users.yes') : lang('Users.no') ?></td>
            <td><?= $u['is_admin'] ? lang('Users.yes') : lang('Users.no') ?></td>
            <td><?= esc($u['created_at']) ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php if ($page > 1): ?>
    <a class="btn btn-primary" href="/users?page=<?= $page - 1 ?>"><?= lang('Users.newer') ?></a>
<?php endif; ?>
<?php if ($hasOlder): ?>
    <a class="btn btn-primary" href="/users?page=<?= $page + 1 ?>"><?= lang('Users.older') ?></a>
<?php endif; ?>
<?= $this->endSection() ?>