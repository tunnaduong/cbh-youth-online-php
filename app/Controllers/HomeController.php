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
        return $this->render('home.index');
    }

    public function saved()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit();
        }
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

    public function fetchFeed()
    {
        $posts = $this->post->newsfeed();
        return $this->render('home.fetch-feed', compact('posts'));
    }

    public function youthNews()
    {
        return $this->render('youth-news.index');
    }

    public function fetchYouthNews()
    {
        $posts = $this->post->youthNews();
        return $this->render('youth-news.fetch-feed', compact('posts'));
    }
}
