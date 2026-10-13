<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<h2><?= lang('App.login') ?></h2>
<form method="post" action="/login">
    <?= csrf_field() ?>
    <div class="mb-3"><label><?= lang('Email') ?></label>
        <input class="form-control" type="email" name="email" value="<?= esc(old('email')) ?>" required></div>
    <div class="mb-3"><label><?= lang('Password') ?></label>
        <input class="form-control" type="password" name="password" required></div>
    <div class="form-check mb-3">
        <input class="form-check-input" type="checkbox" name="remember" id="remember">
        <label class="form-check-label" for="remember"><?= lang('Remember') ?></label>
    </div>
    <button class="btn btn-success"><?= lang('App.login') ?></button>
    <a href="/forgot"><?= lang('Forgot') ?></a>
</form>
<?= $this->endSection() ?>