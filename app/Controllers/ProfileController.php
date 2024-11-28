<?php

namespace App\Controllers;

use App\Models\Post;
use App\Models\Profile;

class ProfileController extends BaseController
{
    protected $profileModel;
    protected $postModel;

    public function __construct()
    {
        $this->profileModel = new Profile();
        $this->postModel = new Post();
    }

    public function index($username)
    {
        $profile = $this->profileModel->getProfile($username);
        $posts = $this->postModel->getPostsByUser($profile->uid ?? null);
        return $this->render('profile.index', compact('profile', 'posts'));
    }
}
