<?php

namespace App\Models;

class Follow extends BaseModel
{
    public function follow($followerId, $followedId)
    {
        $this->setQuery("INSERT INTO cyo_user_followers (follower_id, followed_id, created_at) VALUES (?, ?, ?)");
        return $this->execute([$followerId, $followedId, date('Y-m-d H:i:s')]);
    }

    public function unfollow($followerId, $followedId)
    {
        $this->setQuery("DELETE FROM cyo_user_followers WHERE follower_id = ? AND followed_id = ?");
        return $this->execute([$followerId, $followedId]);
    }

    public function isFollowing($followerId, $followedId)
    {
        $this->setQuery("SELECT * FROM cyo_user_followers WHERE follower_id = ? AND followed_id = ?");
        return $this->loadRow([$followerId, $followedId]);
    }
}
