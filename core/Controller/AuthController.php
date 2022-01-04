<?php


namespace Warehouse\Controller;


class AuthController
{
    public static function check()
    {
        $user_session = $_SESSION['username'];

        if ($user_session) {
            $user_cookie = $_COOKIE['hospital_' . $user_session];
            if ($user_cookie) {
                return $user_session === $user_cookie;
            }
        }
        return false;
    }
}