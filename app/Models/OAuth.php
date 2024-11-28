<?php

namespace App\Models;

use App\Models\BaseModel;

class OAuth extends BaseModel
{
    public function register($provider, $username, $email, $name, $profile_picture)
    {
        $this->setQuery("INSERT INTO cyo_auth_accounts (username, email, provider, created_at, updated_at, email_verified_at) VALUES (?, ?, ?, ?, ?, ?)");
        $this->execute([$username, $email, $provider, date('Y-m-d H:i:s'), date('Y-m-d H:i:s'), $email == null ? null : date('Y-m-d H:i:s')]);

        // Get the last inserted ID
        $authAccountId = $this->getLastId();

        $this->setQuery("INSERT INTO cyo_user_profiles (auth_account_id, profile_name, profile_username, oauth_profile_picture, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)");
        $this->execute([$authAccountId, $name, $username, $profile_picture, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);

        return true;
    }

    public function login($provider, $usernameOrEmail)
    {
        $this->setQuery("SELECT * FROM cyo_auth_accounts WHERE provider = ? AND (username = ? OR email = ?)");
        return $this->loadRow([$provider, $usernameOrEmail, $usernameOrEmail]);
    }

    public function checkForEmailDuplicate($email)
    {
        $this->setQuery("SELECT * FROM cyo_auth_accounts WHERE email = ?");
        return $this->loadRow([$email]);
    }
}
