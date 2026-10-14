<?php
namespace App\Controllers;
use App\Models\TaskModel;

class Tasks extends BaseController
{
    private const PER_PAGE = 10;

    public function index()
    {
        $page = max(1, (int) $this->request->getGet('page'));
        $q = trim((string) $this->request->getGet('q'));
        $m = new TaskModel();
        if ($q !== '') { $m->like('description', $q); }
        $tasks = $m->orderBy('id', 'DESC')->findAll(self::PER_PAGE + 1, ($page - 1) * self::PER_PAGE);
        return view('tasks/index', [
            'tasks'    => array_slice($tasks, 0, self::PER_PAGE),
            'page'     => $page,
            'q'        => $q,
            'hasOlder' => count($tasks) > self::PER_PAGE,
        ]);
    }

    public function new() { return view('tasks/new'); }

    public function create()
    {
        if (! $this->validate(['description' => 'required|max_length[255]'])) {
            return redirect()->back()->withInput()->with('error', implode(' ', $this->validator->getErrors()));
        }
        (new TaskModel())->insert(['description' => $this->request->getPost('description')]);
        return redirect()->to('/tasks')->with('success', lang('Tasks.created'));
    }

    public function show($id)
    {
        $t = (new TaskModel())->find($id);
        if (! $t) { return redirect()->to('/tasks')->with('error', lang('Tasks.not_found')); }
        return view('tasks/show', ['t' => $t]);
    }

    public function edit($id)
    {
        $t = (new TaskModel())->find($id);
        if (! $t) { return redirect()->to('/tasks')->with('error', lang('Tasks.not_found')); }
        return view('tasks/edit', ['t' => $t]);
    }

    public function update($id)
    {
        $m = new TaskModel();
        if (! $m->find($id)) { return redirect()->to('/tasks')->with('error', lang('Tasks.not_found')); }
        if (! $this->validate(['description' => 'required|max_length[255]'])) {
            return redirect()->back()->withInput()->with('error', implode(' ', $this->validator->getErrors()));
        }
        $m->update($id, ['description' => $this->request->getPost('description')]);
        return redirect()->to("/tasks/$id")->with('success', lang('Tasks.updated'));
    }

    public function delete($id)
    {
        (new TaskModel())->delete($id);
        return redirect()->to('/tasks')->with('success', lang('Tasks.deleted'));
    }
}