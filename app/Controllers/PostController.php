<?php

namespace App\Controllers;

use App\Models\Post;
use App\Controllers\BaseController;

class PostController extends BaseController
{
    public $post;

    public function __construct()
    {
        $this->post = new Post();
    }

    public function addNewPost()
    {
        $this->post->addNewPost();
        $posts = $this->post->newsfeed();
        return $this->render('home.index', compact('posts'));
    }
}
