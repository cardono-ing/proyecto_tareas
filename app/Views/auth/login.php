<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<h2><?= lang('App.login') ?></h2>
<form method="post" action="/login">
    <?= csrf_field() ?>
    <div class="mb-3"><label><?= lang('Auth.email') ?></label>
        <input class="form-control" type="email" name="email" value="<?= esc(old('email')) ?>" required></div>
    <div class="mb-3"><label><?= lang('Auth.password') ?></label>
        <input class="form-control" type="password" name="password" required></div>
    <div class="form-check mb-3">
        <input class="form-check-input" type="checkbox" name="remember" id="remember">
        <label class="form-check-label" for="remember"><?= lang('Auth.remember') ?></label>
    </div>
    <button class="btn btn-success"><?= lang('App.login') ?></button>
    <a href="/forgot"><?= lang('Auth.forgot') ?></a>
</form>
<?= $this->endSection() ?>