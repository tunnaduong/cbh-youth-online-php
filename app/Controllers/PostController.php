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
        header('Location: /');
        return $this->render('home.index', compact('posts'));
    }

    public function incrementView($postId)
    {
        $success = $this->post->incrementViewCount($postId);

        if ($success) {
            echo json_encode(["status" => "success", "message" => "View count incremented."]);
        } else {
            echo json_encode(["status" => "error", "message" => "Failed to increment view count."]);
        }
    }

    public function postDetail($username, $postId)
    {
        $post = $this->post->getPostDetail($postId);
        $comments = $this->post->getComments($postId);
        return $this->render('post.index', compact('post', 'comments'));
    }
}
