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

    public function handleToggleFollowAndUnfollow()
    {
        if (!isset($_SESSION['user'])) {
            echo json_encode(['status' => 'unauthorized']);
            exit;
        }

        $followerId = $_SESSION['user']->id;
        $followedId = $_GET['followed_id'] ?? null;

        $isFollowing = $this->followModel->isFollowing($followerId, $followedId);
        if ($isFollowing) {
            $this->followModel->unfollow($followerId, $followedId);
            echo json_encode(['status' => 'unfollowed']);
        } else {
            $this->followModel->follow($followerId, $followedId);
            echo json_encode(['status' => 'followed']);
        }
    }
}
