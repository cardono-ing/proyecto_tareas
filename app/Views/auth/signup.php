<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<h2><?= lang('App.signup') ?></h2>
<?php foreach ((array) session()->getFlashdata('errors') as $e): ?>
    <div class="alert alert-danger"><?= esc($e) ?></div>
<?php endforeach; ?>
<form method="post" action="/signup">
    <?= csrf_field() ?>
    <div class="mb-3"><label><?= lang('Auth.name') ?></label>
        <input class="form-control" name="name" value="<?= esc(old('name')) ?>" required></div>
    <div class="mb-3"><label><?= lang('Auth.email') ?></label>
        <input class="form-control" type="email" name="email" value="<?= esc(old('email')) ?>" required></div>
    <div class="mb-3"><label><?= lang('Auth.password') ?></label>
        <input class="form-control" type="password" name="password" required></div>
    <div class="mb-3"><label><?= lang('Auth.repeat') ?></label>
        <input class="form-control" type="password" name="repeat" required></div>
    <button class="btn btn-success"><?= lang('App.signup') ?></button>
    <a class="btn btn-danger" href="/"><?= lang('Auth.cancel') ?></a>
</form>
<?= $this->endSection() ?>