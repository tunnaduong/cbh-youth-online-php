<?php

namespace App\Models;

use App\Models\BaseModel;

class Post extends BaseModel
{
    public function newsfeed()
    {
        $this->setQuery("SELECT ct.id AS post_id, ct.*, COUNT(DISTINCT v.id) AS post_views, COUNT(DISTINCT c.id) AS post_comments, COUNT(DISTINCT vo.id) AS post_votes, up.*, ua.* FROM cyo_topics ct INNER JOIN cyo_auth_accounts ua ON ct.user_id = ua.id INNER JOIN cyo_user_profiles up ON ua.id = up.auth_account_id LEFT JOIN cyo_topic_views v ON ct.id = v.topic_id LEFT JOIN cyo_topic_comments c ON ct.id = c.topic_id LEFT JOIN cyo_topic_votes vo ON ct.id = vo.topic_id GROUP BY ct.id, up.id, ua.id ORDER BY ct.created_at DESC");
        return $this->loadAllRows();
    }
}
