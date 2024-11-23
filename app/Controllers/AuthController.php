<?php

namespace App\Controllers;

use App\Models\AuthAccount;
use App\Controllers\BaseController;

class AuthController extends BaseController
{
    private $authAccount;

    public function __construct()
    {
        $this->authAccount = new AuthAccount();
    }

    public function login()
    {
        if (isset($_SESSION['user'])) {
            header("Location: /");
            exit;
        }

        $error = "";
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $user = $this->authAccount->checkLogin($username, $password);

            if ($user) {
                $user->additional_info = $this->authAccount->getByUsername($user->username);
                $_SESSION['user'] = $user;
                header("Location: /");
                exit;
            } else {
                $error = "Tên đăng nhập hoặc mật khẩu sai!";
            }
        }

        return $this->render('auth.login', compact('error'));
    }

    public function register()
    {
        $error = "";
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // if username or password or email is empty then return error
            if (empty($_POST['username']) || empty($_POST['name']) || empty($_POST['password']) || empty($_POST['email'])) {
                $error = "Tên đăng nhập, họ và tên, mật khẩu và email không được để trống";
                return $this->render('auth.register', compact('error'));
            } else {
                // if password and confirm password is not match then return error
                if ($_POST['password'] != $_POST['confirm_password']) {
                    $error = "Mật khẩu và xác nhận mật khẩu không khớp";
                    return $this->render('auth.register', compact('error'));
                }
            }
            $username = $_POST['username'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $email = $_POST['email'];

            $user = $this->authAccount->checkExistUsername($username);

            if ($user) {
                $error = "Username already exists";
            } else {
                $user = $this->authAccount->checkExistEmail($email);

                if ($user) {
                    $error = "Email already exists";
                } else {
                    $this->authAccount->register($username, $password, $email);
                    $error = "Register successfully";
                }
            }
        }

        return $this->render('auth.register', compact('error'));
    }

    public function logout()
    {
        unset($_SESSION['user']);
        header("Location: /login");
        exit;
    }
}
