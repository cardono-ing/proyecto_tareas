<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<h2><?= lang('Password.reset_title') ?></h2>
<form method="post" action="/reset/<?= esc($token, 'url') ?>">
    <?= csrf_field() ?>
    <div class="mb-3"><label><?= lang('Auth.password') ?></label>
        <input class="form-control" type="password" name="password" required></div>
    <div class="mb-3"><label><?= lang('Auth.repeat') ?></label>
        <input class="form-control" type="password" name="repeat" required></div>
    <button class="btn btn-success"><?= lang('Password.reset_btn') ?></button>
</form>
<?= $this->endSection() ?>