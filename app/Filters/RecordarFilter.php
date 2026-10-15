<?php
namespace App\Filters;

use App\Models\UserModel;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class RecordarFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (session()->get('user_id')) {
            return;
        }
        $cookie = $request->getCookie('recordar');
        if (! $cookie || strpos($cookie, ':') === false) {
            return;
        }
        [$id, $token] = explode(':', $cookie, 2);
        $u = (new UserModel())->find((int) $id);
        if ($u && $u['active'] && $u['remember_token']
            && hash_equals($u['remember_token'], hash('sha256', $token))) {
            session()->set(['user_id' => $u['id'], 'user_name' => $u['name'], 'is_admin' => (bool) $u['is_admin']]);
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}