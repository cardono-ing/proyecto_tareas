<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<h2><?= lang('Profile.change_password') ?></h2>
<form method="post" action="/profile/password">
    <?= csrf_field() ?>
    <div class="mb-3"><label><?= lang('Profile.current') ?></label>
        <input class="form-control" type="password" name="current" required></div>
    <div class="mb-3"><label><?= lang('Profile.new') ?></label>
        <input class="form-control" type="password" name="new" required></div>
    <div class="mb-3"><label><?= lang('Profile.repeat') ?></label>
        <input class="form-control" type="password" name="repeat" required></div>
    <button class="btn btn-success"><?= lang('Profile.save') ?></button>
    <a class="btn btn-danger" href="/profile"><?= lang('Profile.cancel') ?></a>
</form>
<?= $this->endSection() ?>