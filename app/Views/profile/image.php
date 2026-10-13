<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<h2><?= lang('Profile.change_image') ?></h2>
<form method="post" action="/profile/image" enctype="multipart/form-data">
    <?= csrf_field() ?>
    <div class="mb-3"><input class="form-control" type="file" name="image" accept="image/*" required></div>
    <button class="btn btn-success"><?= lang('Profile.save') ?></button>
    <a class="btn btn-danger" href="/profile"><?= lang('Profile.cancel') ?></a>
</form>
<?= $this->endSection() ?>