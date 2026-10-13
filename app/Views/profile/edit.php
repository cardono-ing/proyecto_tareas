<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<h2><?= lang('Profile.edit') ?></h2>
<form method="post" action="/profile/edit">
    <?= csrf_field() ?>
    <div class="mb-3"><label><?= lang('Auth.name') ?></label>
        <input class="form-control" name="name" value="<?= esc(old('name', $u['name'])) ?>" required></div>
    <div class="mb-3"><label><?= lang('Auth.email') ?></label>
        <input class="form-control" type="email" name="email" value="<?= esc(old('email', $u['email'])) ?>" required></div>
    <button class="btn btn-success"><?= lang('Profile.save') ?></button>
    <a class="btn btn-danger" href="/profile"><?= lang('Profile.cancel') ?></a>
</form>
<?= $this->endSection() ?>