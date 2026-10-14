<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<h2><?= lang('Profile.title') ?></h2>
<a href="/users"><?= lang('Users.back') ?></a>
<dl class="mt-3">
    <dt><?= lang('Auth.name') ?></dt><dd><?= esc($u['name']) ?></dd>
    <dt><?= lang('Auth.email') ?></dt><dd><?= esc($u['email']) ?></dd>
    <dt><?= lang('Users.active') ?></dt><dd><?= $u['active'] ? lang('Users.yes') : lang('Users.no') ?></dd>
    <dt><?= lang('Users.admin') ?></dt><dd><?= $u['is_admin'] ? lang('Users.yes') : lang('Users.no') ?></dd>
    <dt><?= lang('Users.created_at') ?></dt><dd><?= esc($u['created_at']) ?></dd>
    <dt><?= lang('Users.updated_at') ?></dt><dd><?= esc($u['updated_at']) ?></dd>
</dl>
<a class="btn btn-primary" href="/users/<?= (int) $u['id'] ?>/edit"><?= lang('Users.edit') ?></a>
<form method="post" action="/users/<?= (int) $u['id'] ?>/delete" class="d-inline"
      onsubmit="return confirm('<?= esc(lang('Users.confirm_delete'), 'js') ?>')">
    <?= csrf_field() ?>
    <button class="btn btn-danger"><?= lang('Users.delete') ?></button>
</form>
<?= $this->endSection() ?>