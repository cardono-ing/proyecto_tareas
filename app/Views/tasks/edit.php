<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<h2><?= lang('Tasks.edit') ?></h2>
<form method="post" action="/tasks/<?= (int) $t['id'] ?>/edit">
    <?= csrf_field() ?>
    <div class="mb-3"><label><?= lang('Tasks.description') ?></label>
        <input class="form-control" name="description" value="<?= esc(old('description', $t['description'])) ?>" required maxlength="255"></div>
    <button class="btn btn-success"><?= lang('Tasks.save') ?></button>
    <a class="btn btn-danger" href="/tasks/<?= (int) $t['id'] ?>"><?= lang('Tasks.cancel') ?></a>
</form>
<?= $this->endSection() ?>