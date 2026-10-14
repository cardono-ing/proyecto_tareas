<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<h2><?= lang('Users.new') ?></h2>
<a href="/users"><?= lang('Users.back') ?></a>
<form method="post" action="/users/new" class="mt-3">
    <?= csrf_field() ?>
    <div class="mb-3"><label><?= lang('Auth.name') ?></label>
        <input class="form-control" name="name" value="<?= esc(old('name')) ?>" required></div>
    <div class="mb-3"><label><?= lang('Auth.email') ?></label>
        <input class="form-control" type="email" name="email" value="<?= esc(old('email')) ?>" required></div>
    <div class="mb-3"><label><?= lang('Auth.password') ?></label>
        <input class="form-control" type="password" name="password" required></div>
    <div class="mb-3"><label><?= lang('Auth.repeat') ?></label>
        <input class="form-control" type="password" name="repeat" required></div>
    <button class="btn btn-success"><?= lang('Users.save') ?></button>
    <a class="btn btn-danger" href="/users"><?= lang('Users.cancel') ?></a>
</form>
<?= $this->endSection() ?>