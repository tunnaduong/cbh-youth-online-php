<?php

namespace App\Controllers;

use App\Models\SavePost;

class SavePostController extends BaseController
{
    private $savePostModel;

    public function __construct()
    {
        $this->savePostModel = new SavePost();
    }

    // API to toggle the saved status of a post
    public function toggleSavePost($postId)
    {
        $userId = $_SESSION['user']->id;
        // Check if the post is already saved by the user
        $isSaved = $this->savePostModel->isPostSaved($postId, $userId);

        if ($isSaved) {
            // If already saved, unsave the post
            $this->savePostModel->unsavePost($postId, $userId);
            echo json_encode(['status' => 'unsaved', 'message' => 'Post unsaved successfully.']);
        } else {
            // If not saved, save the post
            $this->savePostModel->savePost($postId, $userId);
            echo json_encode(['status' => 'saved', 'message' => 'Post saved successfully.']);
        }
    }
}
