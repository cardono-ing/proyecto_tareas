<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<h2><?= lang('Users.edit') ?></h2>
<a href="/users/<?= (int) $u['id'] ?>"><?= lang('Users.back') ?></a>
<form method="post" action="/users/<?= (int) $u['id'] ?>/edit" class="mt-3">
    <?= csrf_field() ?>
    <div class="mb-3"><label><?= lang('Auth.name') ?></label>
        <input class="form-control" name="name" value="<?= esc(old('name', $u['name'])) ?>" required></div>
    <div class="mb-3"><label><?= lang('Auth.email') ?></label>
        <input class="form-control" type="email" name="email" value="<?= esc(old('email', $u['email'])) ?>" required></div>
    <div class="mb-3"><label><?= lang('Auth.password') ?></label>
        <input class="form-control" type="password" name="password">
        <div class="form-text"><?= lang('Users.pw_hint') ?></div></div>
    <div class="mb-3"><label><?= lang('Auth.repeat') ?></label>
        <input class="form-control" type="password" name="repeat"></div>
    <div class="form-check"><input class="form-check-input" type="checkbox" name="active" id="active" <?= $u['active'] ? 'checked' : '' ?>>
        <label class="form-check-label" for="active"><?= lang('Users.active') ?></label></div>
    <div class="form-check mb-3"><input class="form-check-input" type="checkbox" name="is_admin" id="is_admin" <?= $u['is_admin'] ? 'checked' : '' ?>>
        <label class="form-check-label" for="is_admin"><?= lang('Users.admin') ?></label></div>
    <button class="btn btn-success"><?= lang('Users.save') ?></button>
    <a class="btn btn-danger" href="/users/<?= (int) $u['id'] ?>"><?= lang('Users.cancel') ?></a>
</form>
<?= $this->endSection() ?>