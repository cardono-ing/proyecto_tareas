<!DOCTYPE html>
<html lang="<?= service('request')->getLocale() ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Organizador de tareas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand navbar-dark bg-dark px-3">
    <a class="nav-link text-white me-3" href="/"><?= lang('App.home') ?></a>
    <a class="nav-link text-white me-3" href="/lang/en"><?= lang('App.english') ?></a>
    <a class="nav-link text-white me-3" href="/lang/es"><?= lang('App.spanish') ?></a>
    <div class="ms-auto d-flex">
    <?php if (session()->get('user_id')): ?>
        <span class="nav-link text-white me-3"><?= lang('App.hello') ?>, <?= esc(session()->get('user_name')) ?></span>
        <a class="nav-link text-white me-3" href="/profile"><?= lang('App.profile') ?></a>
        <?php if (session()->get('is_admin')): ?>
            <a class="nav-link text-white me-3" href="/users"><?= lang('App.users') ?></a>
        <?php endif; ?>
        <a class="nav-link text-white me-3" href="/tasks"><?= lang('App.tasks') ?></a>
        <a class="nav-link text-white me-3" href="/logout"><?= lang('App.logout') ?></a>
    <?php else: ?>
        <a class="nav-link text-white me-3" href="/signup"><?= lang('App.signup') ?></a>
        <a class="nav-link text-white me-3" href="/login"><?= lang('App.login') ?></a>
    <?php endif; ?>
    </div>
</nav>
<div class="container mt-4">
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= esc(session()->getFlashdata('success')) ?></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= esc(session()->getFlashdata('error')) ?></div>
    <?php endif; ?>
    <?= $this->renderSection('content') ?>
</div>
</body>
</html>
