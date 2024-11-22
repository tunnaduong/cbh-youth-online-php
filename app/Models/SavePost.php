<?php

namespace App\Models;

use App\Models\BaseModel;

class SavePost extends BaseModel
{
    // Check if the post is already saved by the user
    public function isPostSaved($postId, $userId)
    {
        $this->setQuery("SELECT COUNT(*) FROM cyo_user_saved_topics WHERE topic_id = ? AND user_id = ?");
        return $this->loadRecord([$postId, $userId]) > 0;
    }

    // Save a post
    public function savePost($postId, $userId)
    {
        $this->setQuery("INSERT INTO cyo_user_saved_topics (topic_id, user_id, created_at, updated_at) VALUES (?, ?, ?, ?)");
        return $this->execute([$postId, $userId, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
    }

    // Unsave a post
    public function unsavePost($postId, $userId)
    {
        $this->setQuery("DELETE FROM cyo_user_saved_topics WHERE topic_id = ? AND user_id = ?");
        return $this->execute([$postId, $userId]);
    }
}
