<?php

namespace App\Controllers;

use Exception;
use App\Models\OAuth;
use App\Models\AuthAccount;
use League\OAuth2\Client\Provider\Google;

class GoogleController extends BaseController
{
    protected $provider;
    protected $oauth;
    protected $authAccount;

    public function __construct()
    {
        $config = require 'config/oauth.php';
        $this->provider = new Google([
            'clientId'     => $config['google']['clientId'],
            'clientSecret' => $config['google']['clientSecret'],
            'redirectUri'  => $config['google']['redirectUri'],
        ]);
        $this->oauth = new OAuth();
        $this->authAccount = new AuthAccount();
    }

    public function redirectToProvider()
    {
        $authUrl = $this->provider->getAuthorizationUrl();
        $_SESSION['oauth2state'] = $this->provider->getState();
        header('Location: ' . $authUrl);
        exit;
    }

    public function handleProviderCallback()
    {
        if (isset($_GET['error'])) {
            $error = 'Error: ' . $_GET['error'];
            return $this->render('errors.404', compact('error'));
        }

        if (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {
            unset($_SESSION['oauth2state']);
            $error = 'Error: Invalid state';
            return $this->render('errors.404', compact('error'));
        }

        try {
            $token = $this->provider->getAccessToken('authorization_code', [
                'code' => $_GET['code'] ?? null
            ]);

            // Get user details
            $googleUser = $this->provider->getResourceOwner($token);
            $userData = $googleUser->toArray();

            // Process and save the user data
            $this->loginOrCreateUser($userData);
        } catch (Exception $e) {
            $error = 'Failed to get access token: ' . $e->getMessage();
            return $this->render('errors.404', compact('error'));
        }
    }

    protected function loginOrCreateUser($userData)
    {
        // Save user to database and log them in
        // Redirect or show appropriate response
        $user = $this->oauth->login('google', $userData['email']);
        if ($user) {
            $user->additional_info = $this->authAccount->getByUsername($user->username);
            $_SESSION['user'] = $user;
            header('Location: /');
            exit;
        } else {
            // Check for duplicate email
            $duplicate = $this->oauth->checkForEmailDuplicate($userData['email']);
            if ($duplicate) {
                $error = 'Email đã tồn tại trong hệ thống. Vui lòng sử dụng email khác hoặc đăng nhập bằng email này.';
                return $this->render('auth.login', compact('error'));
            }

            // Register the user
            $this->oauth->register('google', $userData['sub'], $userData['email'], $userData['name'], $userData['picture']);
            $user = $this->oauth->login('google', $userData['email']);
            $user->additional_info = $this->authAccount->getByUsername($user->username);
            $_SESSION['user'] = $user;
            header('Location: /');
            exit;
        }
    }
}
