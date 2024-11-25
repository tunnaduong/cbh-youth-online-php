<?php

namespace App\Controllers;

use League\OAuth2\Client\Provider\Google;
use Exception;

class GoogleController extends BaseController
{
    protected $provider;

    public function __construct()
    {
        $config = require 'config/oauth.php';
        $this->provider = new Google([
            'clientId'     => $config['google']['clientId'],
            'clientSecret' => $config['google']['clientSecret'],
            'redirectUri'  => $config['google']['redirectUri'],
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
        echo "<pre>";
        var_dump($userData);
        echo "</pre>";
    }
}
