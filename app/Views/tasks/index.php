<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<h2><?= lang('Tasks.title') ?></h2>
<a class="btn btn-primary mb-3" href="/tasks/new"><?= lang('Tasks.new') ?></a>
<form method="get" action="/tasks" class="mb-3 d-flex gap-2">
    <input class="form-control" name="q" value="<?= esc($q) ?>" placeholder="<?= lang('Tasks.search') ?>">
    <button class="btn btn-secondary"><?= lang('Tasks.search') ?></button>
</form>
<?php if (empty($tasks)): ?>
    <p><?= lang('Tasks.empty') ?></p>
<?php endif; ?>
<ul class="list-unstyled">
<?php foreach ($tasks as $t): ?>
    <li class="mb-1"><a href="/tasks/<?= (int) $t['id'] ?>"><?= esc($t['description']) ?></a></li>
<?php endforeach; ?>
</ul>
<?php if ($page > 1): ?>
    <a class="btn btn-primary" href="/tasks?page=<?= $page - 1 ?>&q=<?= urlencode($q) ?>"><?= lang('Tasks.newer') ?></a>
<?php endif; ?>
<?php if ($hasOlder): ?>
    <a class="btn btn-primary" href="/tasks?page=<?= $page + 1 ?>&q=<?= urlencode($q) ?>"><?= lang('Tasks.older') ?></a>
<?php endif; ?>
<?= $this->endSection() ?>