<?php


namespace Warehouse\Controller;

use Warehouse\Model\User;
use Warehouse\Request\Request;
use Warehouse\View\View;

class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        if (AuthController::check()) {
            $this->redirect('/account');
        }
        View::render('auth.register');
    }

    public function register()
    {
        $request = new Request();
        $data = $request->getBody();
        $name = $data['name'];
        $username = $data['username'];
        $password = password_hash($data['password'], PASSWORD_DEFAULT);
        User::create([
            'name' => $name,
            'username' => $username,
            'password' => $password
        ]);
        //Generate a random string.
        $token = openssl_random_pseudo_bytes(16);
        //Convert the binary data into hexadecimal representation.
        $token = bin2hex($token);
        $_SESSION['username'] = $token;
        setcookie("warehouse_" . $token, $token, time() + 7200);
        $this->redirect('/account');
    }
}