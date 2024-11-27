<?php

namespace App\Controllers;

use App\Models\Follow;
use App\Controllers\BaseController;

class FollowController extends BaseController
{
    protected $followModel;

    public function __construct()
    {
        $this->followModel = new Follow();
    }

    public function handleFollow()
    {
        if (!isset($_SESSION['user'])) {
            // header("Location: /login");
            echo json_encode(['status' => 'unauthorized']);
            exit;
        }

        $followerId = $_SESSION['user']->id;
        $followedId = $_POST['followed_id'];

        $this->followModel->follow($followerId, $followedId);
        // return json response
        echo json_encode(['status' => 'success']);
    }
}
