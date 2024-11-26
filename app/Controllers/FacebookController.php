<?php

namespace App\Controllers;

use League\OAuth2\Client\Provider\Facebook;
use Exception;

class FacebookController
{
    protected $provider;

    public function __construct()
    {
        $config = require 'config/oauth.php';
        $this->provider = new Facebook([
            'clientId'          => $config['facebook']['clientId'],
            'clientSecret'      => $config['facebook']['clientSecret'],
            'redirectUri'       => $config['facebook']['redirectUri'],
            'graphApiVersion'   => $config['facebook']['graphApiVersion'],
        ]);
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
        if (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {
            unset($_SESSION['oauth2state']);
            exit('Invalid state');
        }

        try {
            $token = $this->provider->getAccessToken('authorization_code', [
                'code' => $_GET['code']
            ]);

            // Get user details
            $facebookUser = $this->provider->getResourceOwner($token);
            $userData = $facebookUser->toArray();

            // Process and save the user data
            $this->loginOrCreateUser($userData);
        } catch (Exception $e) {
            exit('Failed to get access token: ' . $e->getMessage());
        }
    }

    protected function loginOrCreateUser($userData)
    {
        // Save user to database and log them in
        // Redirect or show appropriate response
    }
}
