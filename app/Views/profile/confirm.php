<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<h2><?= lang('Profile.enter_pw') ?></h2>
<form method="post" action="/profile/confirm">
    <?= csrf_field() ?>
    <div class="mb-3"><label><?= lang('Auth.password') ?></label>
        <input class="form-control" type="password" name="password" required></div>
    <button class="btn btn-success"><?= lang('Auth.send') ?></button>
    <a class="btn btn-danger" href="/profile"><?= lang('Profile.cancel') ?></a>
</form>
<?= $this->endSection() ?>