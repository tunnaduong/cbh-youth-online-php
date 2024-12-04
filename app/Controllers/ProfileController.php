<?php

namespace App\Controllers;

use App\Models\AuthAccount;
use App\Models\Post;
use App\Models\Profile;
use DateTime;

class ProfileController extends BaseController
{
    protected $profileModel;
    protected $postModel;
    protected $authModel;

    public function __construct()
    {
        $this->profileModel = new Profile();
        $this->postModel = new Post();
        $this->authModel = new AuthAccount();
    }

    public function index($username)
    {
        $profile = $this->profileModel->getProfile($username);
        $posts = $this->postModel->getPostsByUser($profile->uid ?? null);
        return $this->render('profile.index', compact('profile', 'posts'));
    }

    public function edit($username)
    {
        $profile = $this->profileModel->getProfile($username);

        if ($username !== $_SESSION['user']->username) {
            header("Location: /$username");
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // if username is empty
            if (empty($_POST['username'])) {
                $_SESSION['error']['username'] = 'Tên người dùng không được để trống.';
                header("Location: /$username/settings");
                exit();
            }

            if (empty($_POST['email'])) {
                $_SESSION['error']['email'] = 'Email không được để trống.';
                header("Location: /$username/settings");
                exit();
            }

            // if username is different
            if ($_POST['username'] !== $_SESSION['user']->username) {
                // if username is already taken
                $existUsername = $this->authModel->checkExistUsername($_POST['username']);
                if ($existUsername) {
                    $_SESSION['error']['username'] = 'Tên người dùng đã tồn tại.';
                    header("Location: /$username/settings");
                    exit();
                }

                // if last username change is less than 30 days
                $lastUsernameChange = $this->profileModel->getLastUsernameChange($username);
                if ($lastUsernameChange->last_username_change) {
                    $currentDate = new DateTime();
                    $lastChangeDate = new DateTime($lastUsernameChange->last_username_change);

                    // Tính khoảng cách ngày
                    $interval = $currentDate->diff($lastChangeDate);

                    if ($interval->days < 30) {
                        $_SESSION['error']['username'] = 'Bạn chỉ được thay đổi tên người dùng mỗi 30 ngày.';
                        header("Location: /$username/settings");
                        exit();
                    }
                }
            }

            // if bio is less than 4 characters
            if (strlen($_POST['bio']) < 4 && !empty($_POST['bio'])) {
                $_SESSION['error']['bio'] = 'Tiểu sử phải chứa ít nhất 4 ký tự.';
                header("Location: /$username/settings");
                exit();
            }

            $this->profileModel->updateProfile($_POST);
            $profile = $this->profileModel->getProfile($_POST['username']);
            $_SESSION['success'] = 'Cập nhật trang cá nhân thành công — <a href="/' . $_POST['username'] . '"
                class="underline underline-offset-[3.2px]">Xem trang cá nhân
                của bạn</a>.';
            // Redirect to same page
            $_SESSION['user'] = $this->authModel->getUserData($profile->profile_username);
            $_SESSION['user']->additional_info = $profile;
            header("Location: /" . $profile->username . "/settings");
            exit();
        }

        // Get any flash messages
        $error = $_SESSION['error'] ?? null;
        $success = $_SESSION['success'] ?? null;

        // Clear flash messages
        unset($_SESSION['error']);
        unset($_SESSION['success']);

        // Get profile and render view
        $profile = $this->profileModel->getProfile($username);
        return $this->render('profile.edit', compact('profile', 'error', 'success'));
    }
}
