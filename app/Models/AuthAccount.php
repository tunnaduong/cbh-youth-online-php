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
        $this->execute([$username]);
        return $this->loadRow();
    }

    public function checkExistEmail($email)
    {
        $this->setQuery("SELECT * FROM $this->table WHERE email = ?");
        $this->execute([$email]);
        return $this->loadRow();
    }

    public function register($username, $password, $email)
    {
        $this->setQuery("INSERT INTO $this->table (username, password, email, role, status) VALUES (?, ?, ?, 'user', 1)");
        return $this->execute([$username, $password, $email]);
    }

    public function changePassword($id, $password)
    {
        $this->setQuery("UPDATE $this->table SET password = ? WHERE id = ?");
        return $this->execute([$password, $id]);
    }

    public function getAll()
    {
        $this->setQuery("SELECT * FROM $this->table");
        return $this->execute();
    }

    public function getByUsername($username)
    {
        $this->setQuery("SELECT * FROM cyo_user_profiles WHERE profile_username = ?");
        return $this->loadRow([$username]);
    }

    public function delete($id)
    {
        $this->setQuery("DELETE FROM $this->table WHERE id = ?");
        return;
    }
}
