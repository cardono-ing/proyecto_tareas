<?php
namespace App\Controllers;
use App\Models\UserModel;

class Password extends BaseController
{
    public function forgot() { return view('auth/forgot'); }

    public function forgotPost()
    {
        if (! $this->validate(['email' => 'required|valid_email'])) {
            return redirect()->back()->withInput()->with('error', implode(' ', $this->validator->getErrors()));
        }
        $m = new UserModel();
        $u = $m->where('email', $this->request->getPost('email'))->first();
        $msg = lang('Password.sent');

        if ($u) {
            $token = bin2hex(random_bytes(16));
            $m->update($u['id'], [
                'reset_token'   => $token,
                'reset_expires' => date('Y-m-d H:i:s', time() + 3600),
            ]);
            $link = base_url("reset/$token");
            try {
                $mail = service('email');
                $mail->setTo($u['email']);
                $mail->setSubject(lang('Password.subject'));
                $mail->setMessage(lang('Password.body') . ' ' . $link);
                if (! $mail->send(false)) {
                    log_message('error', 'Correo no enviado: ' . $mail->printDebugger(['headers']));
                    }
            } catch (\Throwable $e) {
                log_message('error', 'Error de correo: ' . $e->getMessage());
            }
            if (ENVIRONMENT === 'development') {
                $msg .= ' [DEV] ' . $link;
            }
        }
        return redirect()->to('/login')->with('success', $msg);
    }

    private function findByToken($token)
    {
        return (new UserModel())
            ->where('reset_token', $token)
            ->where('reset_expires >', date('Y-m-d H:i:s'))
            ->first();
    }

    public function reset($token)
    {
        if (! $this->findByToken($token)) {
            return redirect()->to('/login')->with('error', lang('Password.invalid'));
        }
        return view('auth/reset', ['token' => $token]);
    }

    public function resetPost($token)
    {
        $u = $this->findByToken($token);
        if (! $u) {
            return redirect()->to('/login')->with('error', lang('Password.invalid'));
        }
        if (! $this->validate(['password' => 'required|min_length[8]', 'repeat' => 'required|matches[password]'])) {
            return redirect()->back()->withInput()->with('error', implode(' ', $this->validator->getErrors()));
        }
        (new UserModel())->update($u['id'], [
            'password'      => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'reset_token'   => null,
            'reset_expires' => null,
        ]);
        return redirect()->to('/login')->with('success', lang('Password.done'));
    }
}