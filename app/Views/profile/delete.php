<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<h2><?= lang('Profile.delete_image') ?></h2>
<p><?= lang('Profile.sure') ?></p>
<form method="post" action="/profile/image/delete">
    <?= csrf_field() ?>
    <button class="btn btn-success"><?= lang('Profile.save') ?></button>
    <a class="btn btn-danger" href="/profile"><?= lang('Profile.cancel') ?></a>
</form>
<?= $this->endSection() ?>