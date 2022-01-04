<?php


namespace Warehouse\Controller;


use Warehouse\Model\User;
use Warehouse\Request\Request;
use Warehouse\View\View;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        if (AuthController::check()) {
            $this->redirect('/account');
        } else {
            View::render('auth.login');
        }
    }

    public function login()
    {
        $request = new Request();
        $data = $request->getBody();
        $user = User::whereOne(['username', '=', $data['username']]);
        $password = $data['password'];
        if ($user) {
            if ($user['password'] && password_verify($password, $user['password'])) {
                $token = openssl_random_pseudo_bytes(16);
                //Convert the binary data into hexadecimal representation.
                $token = bin2hex($token);
                $_SESSION['username'] = $token;
                setcookie("warehouse_" . $token, $token, time() + 7200);
                $this->redirect('/account');
            } else {
                $this->redirect('/login');
            }
        }else{
            $this->redirect('/login');
        }

    }
}