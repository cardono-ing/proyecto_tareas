<?php
namespace App\Controllers;
use App\Models\UserModel;

class Profile extends BaseController
{
    private function me() { return (new UserModel())->find(session()->get('user_id')); }

    private function fail($msg) { return redirect()->back()->withInput()->with('error', $msg); }

    public function index() { return view('profile/index', ['u' => $this->me()]); }

    public function confirm() { return view('profile/confirm'); }

    public function confirmPost()
    {
        if (! password_verify((string) $this->request->getPost('password'), $this->me()['password'])) {
            return $this->fail(lang('Auth.bad_login'));
        }
        session()->set('pw_ok', true);
        return redirect()->to('/profile/edit');
    }

    public function edit()
    {
        if (! session()->get('pw_ok')) { return redirect()->to('/profile/confirm'); }
        return view('profile/edit', ['u' => $this->me()]);
    }

    public function editPost()
    {
        if (! session()->get('pw_ok')) { return redirect()->to('/profile/confirm'); }
        $id = (int) session()->get('user_id');
        $rules = [
            'name'  => 'required|min_length[2]|max_length[100]',
            'email' => "required|valid_email|is_unique[users.email,id,$id]",
        ];
        if (! $this->validate($rules)) { return $this->fail(implode(' ', $this->validator->getErrors())); }
        (new UserModel())->update($id, [
            'name'  => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
        ]);
        session()->set('user_name', $this->request->getPost('name'));
        session()->remove('pw_ok');
        return redirect()->to('/profile')->with('success', lang('Profile.saved'));
    }

    public function password() { return view('profile/password'); }

    public function passwordPost()
    {
        $rules = ['new' => 'required|min_length[8]', 'repeat' => 'required|matches[new]'];
        if (! $this->validate($rules)) { return $this->fail(implode(' ', $this->validator->getErrors())); }
        $u = $this->me();
        if (! password_verify((string) $this->request->getPost('current'), $u['password'])) {
            return $this->fail(lang('Auth.bad_login'));
        }
        (new UserModel())->update($u['id'], [
            'password' => password_hash($this->request->getPost('new'), PASSWORD_DEFAULT),
        ]);
        return redirect()->to('/profile')->with('success', lang('Profile.pw_changed'));
    }

    public function image() { return view('profile/image'); }

    public function imagePost()
    {
        $rules = ['image' => 'uploaded[image]|is_image[image]|max_size[image,2048]|mime_in[image,image/jpg,image/jpeg,image/png,image/webp]'];
        if (! $this->validate($rules)) { return $this->fail(implode(' ', $this->validator->getErrors())); }
        $u = $this->me();
        $file = $this->request->getFile('image');
        $name = $file->getRandomName();
        $file->move(FCPATH . 'uploads/profiles', $name);
        $this->removeImage($u);
        (new UserModel())->update($u['id'], ['image' => $name]);
        return redirect()->to('/profile')->with('success', lang('Profile.img_saved'));
    }

    public function imageDelete() { return view('profile/delete'); }

    public function imageDeletePost()
    {
        $u = $this->me();
        $this->removeImage($u);
        (new UserModel())->update($u['id'], ['image' => null]);
        return redirect()->to('/profile')->with('success', lang('Profile.img_deleted'));
    }

    private function removeImage($u)
    {
        if (! empty($u['image'])) {
            $path = FCPATH . 'uploads/profiles/' . basename($u['image']);
            if (is_file($path)) { unlink($path); }
        }
    }
}