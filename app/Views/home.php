<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="text-center py-5">
    <h1 class="display-5"><?= lang('App.welcome') ?></h1>
    <p class="lead"><?= lang('App.welcome_msg') ?></p>
    <?php if (! session()->get('user_id')): ?>
        <a class="btn btn-success btn-lg" href="/signup"><?= lang('App.signup') ?></a>
        <a class="btn btn-outline-secondary btn-lg" href="/login"><?= lang('App.login') ?></a>
    <?php else: ?>
        <a class="btn btn-success btn-lg" href="/tasks"><?= lang('App.tasks') ?></a>
    <?php endif; ?>
</div>
<?= $this->endSection() ?>