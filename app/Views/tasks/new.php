<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<h2><?= lang('Tasks.new') ?></h2>
<form method="post" action="/tasks/new">
    <?= csrf_field() ?>
    <div class="mb-3"><label><?= lang('Tasks.description') ?></label>
        <input class="form-control" name="description" value="<?= esc(old('description')) ?>" required maxlength="255"></div>
    <button class="btn btn-success"><?= lang('Tasks.send') ?></button>
    <a class="btn btn-danger" href="/tasks"><?= lang('Tasks.cancel') ?></a>
</form>
<?= $this->endSection() ?>