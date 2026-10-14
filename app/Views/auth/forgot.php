<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<h2><?= lang('Password.title') ?></h2>
<form method="post" action="/forgot">
    <?= csrf_field() ?>
    <div class="mb-3"><label><?= lang('Auth.email') ?></label>
        <input class="form-control" type="email" name="email" value="<?= esc(old('email')) ?>" required></div>
    <button class="btn btn-success"><?= lang('Auth.send') ?></button>
    <a class="btn btn-danger" href="/login"><?= lang('Auth.cancel') ?></a>
</form>
<?= $this->endSection() ?>