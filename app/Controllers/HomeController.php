<?php

namespace App\Controllers;

use App\Models\Post;
use App\Controllers\BaseController;

class HomeController extends BaseController
{
    public $post;

    public function __construct()
    {
        $this->post = new Post();
    }

    public function index()
    {
        $posts = $this->post->newsfeed();
        return $this->render('home.index', compact('posts'));
    }

    public function saved()
    {
        $posts = $this->post->saved();
        return $this->render('home.saved', compact('posts'));
    }

    public function report()
    {
        return $this->render('report.index');
    }

    public function lookup()
    {
        return $this->render('lookup.index');
    }

    public function explore()
    {
        return $this->render('explore.index');
    }

    public function error404($error)
    {
        return $this->render('errors.404', compact('error'));
    }
}
