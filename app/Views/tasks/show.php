<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<h2><?= lang('Tasks.title') ?></h2>
<a href="/tasks"><?= lang('Tasks.back') ?></a>
<dl class="mt-3">
    <dt>ID</dt><dd><?= (int) $t['id'] ?></dd>
    <dt><?= lang('Tasks.description') ?></dt><dd><?= esc($t['description']) ?></dd>
    <dt><?= lang('Tasks.created_at') ?></dt><dd><?= esc($t['created_at']) ?></dd>
    <dt><?= lang('Tasks.updated_at') ?></dt><dd><?= esc($t['updated_at']) ?></dd>
</dl>
<a class="btn btn-primary" href="/tasks/<?= (int) $t['id'] ?>/edit"><?= lang('Tasks.edit') ?></a>
<form method="post" action="/tasks/<?= (int) $t['id'] ?>/delete" class="d-inline"
      onsubmit="return confirm('<?= esc(lang('Tasks.confirm_delete'), 'js') ?>')">
    <?= csrf_field() ?>
    <button class="btn btn-danger"><?= lang('Tasks.delete') ?></button>
</form>
<?= $this->endSection() ?>