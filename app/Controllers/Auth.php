<?php
namespace App\Controllers;
use App\Models\UserModel;

class Auth extends BaseController
{
    public function signup() { return view('auth/signup'); }

    public function signupPost()
    {
        $rules = [
            'name'     => 'required|min_length[2]|max_length[100]',
            'email'    => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[8]',
            'repeat'   => 'required|matches[password]',
        ];
        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $token = bin2hex(random_bytes(16));
        (new UserModel())->insert([
            'name'     => $this->request->getPost('name'),
            'email'    => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'active'   => 0,
            'is_admin' => 0,
            'token'    => $token,
        ]);
        return redirect()->to('/login')->with('success', lang('Auth.signup_ok') . base_url("activate/$token"));
    }

    public function activate($token)
    {
        $m = new UserModel();
        $u = $m->where('token', $token)->first();
        if (! $u) { return redirect()->to('/login')->with('error', lang('Auth.bad_token')); }
        $m->update($u['id'], ['active' => 1, 'token' => null]);
        return redirect()->to('/login')->with('success', lang('Auth.activated'));
    }

    public function login() { return view('auth/login'); }

    public function loginPost()
    {
        $u = (new UserModel())->where('email', $this->request->getPost('email'))->first();
        if (! $u || ! password_verify((string) $this->request->getPost('password'), $u['password'])) {
            return redirect()->back()->withInput()->with('error', lang('Auth.bad_login'));
        }
        if (! $u['active']) {
            return redirect()->back()->with('error', lang('Auth.inactive'));
        }
        session()->set(['user_id' => $u['id'], 'user_name' => $u['name'], 'is_admin' => (bool) $u['is_admin']]);
        return redirect()->to('/')->with('success', lang('App.login_ok'));
    }

    public function logout()
    {
        session()->remove(['user_id', 'user_name', 'is_admin']);
        return redirect()->to('/')->with('success', lang('App.logout_ok'));
    }
}