<?php
namespace App\Controllers;
use App\Models\UserModel;

class Users extends BaseController
{
    private const PER_PAGE = 10;

    public function index()
    {
        $page = max(1, (int) $this->request->getGet('page'));
        $m = new UserModel();
        $users = $m->orderBy('id', 'DESC')->findAll(self::PER_PAGE + 1, ($page - 1) * self::PER_PAGE);
        $hasOlder = count($users) > self::PER_PAGE;
        return view('users/index', [
            'users'    => array_slice($users, 0, self::PER_PAGE),
            'page'     => $page,
            'hasOlder' => $hasOlder,
        ]);
    }

    public function new() { return view('users/new'); }

    public function create()
    {
        $rules = [
            'name'     => 'required|min_length[2]|max_length[100]',
            'email'    => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[8]',
            'repeat'   => 'required|matches[password]',
        ];
        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', implode(' ', $this->validator->getErrors()));
        }
        (new UserModel())->insert([
            'name'     => $this->request->getPost('name'),
            'email'    => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'active'   => 1,
            'is_admin' => 0,
        ]);
        return redirect()->to('/users')->with('success', lang('Users.created'));
    }

    public function show($id)
    {
        $u = (new UserModel())->find($id);
        if (! $u) { return redirect()->to('/users')->with('error', lang('Users.not_found')); }
        return view('users/show', ['u' => $u]);
    }

    public function edit($id)
    {
        $u = (new UserModel())->find($id);
        if (! $u) { return redirect()->to('/users')->with('error', lang('Users.not_found')); }
        return view('users/edit', ['u' => $u]);
    }

    public function update($id)
    {
        $m = new UserModel();
        if (! $m->find($id)) { return redirect()->to('/users')->with('error', lang('Users.not_found')); }
        $id = (int) $id;
        $rules = [
            'name'     => 'required|min_length[2]|max_length[100]',
            'email'    => "required|valid_email|is_unique[users.email,id,$id]",
            'password' => 'permit_empty|min_length[8]',
            'repeat'   => 'matches[password]',
        ];
        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', implode(' ', $this->validator->getErrors()));
        }
        $data = [
            'name'     => $this->request->getPost('name'),
            'email'    => $this->request->getPost('email'),
            'active'   => $this->request->getPost('active') ? 1 : 0,
            'is_admin' => $this->request->getPost('is_admin') ? 1 : 0,
        ];
        if ($this->request->getPost('password')) {
            $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }
        $m->update($id, $data);
        if ($id === (int) session()->get('user_id')) {
            session()->set(['user_name' => $data['name'], 'is_admin' => (bool) $data['is_admin']]);
        }
        return redirect()->to("/users/$id")->with('success', lang('Users.updated'));
    }

    public function delete($id)
    {
        if ((int) $id === (int) session()->get('user_id')) {
            return redirect()->to('/users')->with('error', lang('Users.no_self_delete'));
        }
        $m = new UserModel();
        $u = $m->find($id);
        if ($u && ! empty($u['image'])) {
            $path = FCPATH . 'uploads/profiles/' . basename($u['image']);
            if (is_file($path)) { unlink($path); }
        }
        $m->delete($id);
        return redirect()->to('/users')->with('success', lang('Users.deleted'));
    }
}