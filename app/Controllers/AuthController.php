<?php

namespace App\Controllers;

use App\Models\AuthAccount;
use App\Controllers\BaseController;

class AuthController extends BaseController
{
    public function login()
    {
        $error = "";
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $authAccount = new AuthAccount();
            $user = $authAccount->checkLogin($username, $password);

            if ($user) {
                $_SESSION['user'] = $user;
                header("Location: /");
                exit;
            } else {
                $error = "Login failed";
            }
        }

        return $this->render('auth.login', compact('error'));
    }

    public function register()
    {
        if (isset($_POST['register'])) {
            $username = $_POST['username'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $email = $_POST['email'];

            $authAccount = new AuthAccount();
            $user = $authAccount->checkExistUsername($username);

            if ($user) {
                $error = "Username already exists";
            } else {
                $user = $authAccount->checkExistEmail($email);

                if ($user) {
                    $error = "Email already exists";
                } else {
                    $authAccount->register($username, $password, $email);
                    $error = "Register successfully";
                }
            }
        }

        return $this->render('auth.register', compact('error'));
    }

    public function logout()
    {
        unset($_SESSION['user']);
        header("Location: /");
        exit;
    }
}
