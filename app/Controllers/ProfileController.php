<?php

namespace App\Controllers;

use App\Models\Profile;

class ProfileController extends BaseController
{
    protected $profileModel;

    public function __construct()
    {
        $this->profileModel = new Profile();
    }

    public function index($username)
    {
        $profile = $this->profileModel->getProfile($username);
        return $this->render('profile.index', compact('profile'));
    }
}
