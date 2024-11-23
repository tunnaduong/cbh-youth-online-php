<?php

namespace App\Models;

use App\Models\BaseModel;

class AuthAccount extends BaseModel
{
    protected $table = 'cyo_auth_accounts';

    public function __construct()
    {
        parent::__construct();
    }

    public function checkLogin($usernameOrEmail, $password)
    {
        // Retrieve the user record based on the username or email
        $this->setQuery("SELECT * FROM $this->table WHERE username = ? OR email = ?");
        $user = $this->loadRow([$usernameOrEmail, $usernameOrEmail]);

        // Check if user exists and verify the password
        if ($user && password_verify($password, $user->password)) {
            return $user; // Password is correct, return user data
        }

        return false; // Password is incorrect or user does not exist
    }

    public function checkExistUsername($username)
    {
        $this->setQuery("SELECT * FROM $this->table WHERE username = ?");
        return $this->loadRow([$username]);
    }

    public function checkExistEmail($email)
    {
        $this->setQuery("SELECT * FROM $this->table WHERE email = ?");
        return $this->loadRow([$email]);
    }

    public function register($username, $password, $email, $profileName)
    {
        // Insert into auth_account table
        $this->setQuery("INSERT INTO $this->table (username, password, email, created_at, updated_at) VALUES (?, ?, ?, ?, ?)");
        $this->execute([$username, $password, $email, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);

        // Get the last inserted ID
        $authAccountId = $this->getLastId();

        // Insert into cyo_user_profiles table
        $this->setQuery("INSERT INTO cyo_user_profiles (auth_account_id, profile_name, profile_username, created_at, updated_at) VALUES (?, ?, ?, ?, ?)");
        $this->execute([$authAccountId, $profileName, $username, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        return true;
    }

    public function getUserData($username)
    {
        $this->setQuery("SELECT * FROM $this->table WHERE username = ?");
        return $this->loadRow([$username]);
    }

    public function changePassword($id, $password)
    {
        $this->setQuery("UPDATE $this->table SET password = ? WHERE id = ?");
        return $this->execute([$password, $id]);
    }

    public function getAll()
    {
        $this->setQuery("SELECT * FROM $this->table");
        return $this->loadAllRows();
    }

    public function getByUsername($username)
    {
        $this->setQuery("SELECT * FROM cyo_user_profiles WHERE profile_username = ?");
        return $this->loadRow([$username]);
    }

    public function delete($id)
    {
        $this->setQuery("DELETE FROM $this->table WHERE id = $id");
        return $this->execute();
    }

    public function saveVerificationToken($userId, $token)
    {
        $this->setQuery("INSERT INTO cyo_auth_email_verification_code (verification_code, user_id, created_at, updated_at, expires_at) VALUES (?, ?, ?, ?, ?)");
        return $this->execute([$token, $userId, date('Y-m-d H:i:s'), date('Y-m-d H:i:s'), date('Y-m-d H:i:s', strtotime('+1 hour'))]);
    }

    public function getUserIdByToken($token)
    {
        $this->setQuery("SELECT user_id FROM cyo_auth_email_verification_code WHERE verification_code = ?");
        return $this->loadRow([$token])->user_id ?? null;
    }

    public function getUserIdByEmailAndToken($token)
    {
        $this->setQuery("SELECT * FROM cyo_auth_accounts WHERE email = (SELECT email FROM password_reset_tokens WHERE token = ?)");
        return $this->loadRow([$token])->id ?? null;
    }

    public function markAsVerified($userId)
    {
        $this->setQuery("UPDATE cyo_auth_accounts SET email_verified_at = NOW() WHERE id = ?");
        return $this->execute([$userId]);
    }

    public function checkVerified($userId)
    {
        $this->setQuery("SELECT email_verified_at FROM cyo_auth_accounts WHERE id = ?");
        return $this->loadRow([$userId])->email_verified_at !== null;
    }

    public function savePasswordResetToken($email, $token)
    {
        $this->setQuery("INSERT INTO password_reset_tokens (email, token, created_at) VALUES (?, ?, ?)");
        return $this->execute([$email, $token, date('Y-m-d H:i:s')]);
    }

    public function getTokenCreatedAt($token)
    {
        $this->setQuery("SELECT created_at FROM password_reset_tokens WHERE token = ?");
        return $this->loadRow([$token])->created_at ?? null;
    }
}
