<?php

namespace App\Controllers;

use Exception;
use App\Models\OAuth;
use App\Models\AuthAccount;
use League\OAuth2\Client\Provider\Facebook;

class FacebookController extends BaseController
{
    protected $provider;
    protected $oauth;
    protected $authAccount;

    public function __construct()
    {
        $config = require 'config/oauth.php';
        $this->provider = new Facebook([
            'clientId'          => $config['facebook']['clientId'],
            'clientSecret'      => $config['facebook']['clientSecret'],
            'redirectUri'       => $config['facebook']['redirectUri'],
            'graphApiVersion'   => $config['facebook']['graphApiVersion'],
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

        if (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'] ?? null)) {
            unset($_SESSION['oauth2state']);
            $error = 'Error: Invalid state';
            return $this->render('errors.404', compact('error'));
        }

        try {
            $token = $this->provider->getAccessToken('authorization_code', [
                'code' => $_GET['code'] ?? null
            ]);

            // Get user details
            $facebookUser = $this->provider->getResourceOwner($token);
            $userData = $facebookUser->toArray();

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
        $user = $this->oauth->login('facebook', $userData['email'] ?? $userData['id']);
        if ($user) {
            // if user exists, log them in and change avatar
            // if oauth profile picture is different and the avatar is not uploaded, update it
            $user->additional_info = $this->authAccount->getByUsername($user->username);
            if ($user->additional_info->oauth_profile_picture != $userData['picture_url'] && $user->additional_info->profile_picture == null) {
                $this->oauth->updateAvatar($user->id, $userData['picture_url']);
            }
            $_SESSION['user'] = $user;
            header('Location: /');
            exit;
        } else {
            // Check for duplicate email
            $duplicate = $this->oauth->checkForEmailDuplicate($userData['email'] ?? null);
            if ($duplicate) {
                $error = 'Email đã tồn tại trong hệ thống. Vui lòng sử dụng email khác hoặc đăng nhập bằng email này.';
                return $this->render('auth.login', compact('error'));
            }

            // Register the user
            $this->oauth->register('facebook', $userData['id'], $userData['email'] ?? null, $userData['name'], $userData['picture_url']);
            $user = $this->oauth->login('facebook',  $userData['email'] ?? $userData['id']);
            $user->additional_info = $this->authAccount->getByUsername($user->username);
            $_SESSION['user'] = $user;
            header('Location: /');
            exit;
        }
    }
}
