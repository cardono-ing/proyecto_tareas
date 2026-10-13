<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<h2><?= lang('Profile.title') ?></h2>
<?php if (! empty($u['image'])): ?>
    <img src="<?= base_url('uploads/profiles/' . esc($u['image'], 'url')) ?>" width="150" class="img-thumbnail mb-2">
<?php else: ?>
    <img src="data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='150' height='150'><rect width='150' height='150' fill='%23ccc'/><circle cx='75' cy='60' r='28' fill='%23888'/><rect x='35' y='95' width='80' height='45' rx='22' fill='%23888'/></svg>" class="img-thumbnail mb-2">
<?php endif; ?>
<div class="mb-3"><a class="btn btn-danger btn-sm" href="/profile/image/delete"><?= lang('Profile.delete_image') ?></a></div>
<p><strong><?= lang('Auth.name') ?>:</strong> <?= esc($u['name']) ?></p>
<p><strong><?= lang('Auth.email') ?>:</strong> <?= esc($u['email']) ?></p>
<a class="btn btn-primary" href="/profile/confirm"><?= lang('Profile.edit') ?></a>
<a class="btn btn-primary" href="/profile/password"><?= lang('Profile.change_password') ?></a>
<a class="btn btn-primary" href="/profile/image"><?= lang('Profile.change_image') ?></a>
<?= $this->endSection() ?>