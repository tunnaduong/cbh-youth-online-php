<?php

namespace App\Models;

use App\Models\BaseModel;

class Post extends BaseModel
{
    public function newsfeed()
    {
        $this->setQuery("SELECT ct.created_at AS post_created_at, ct.id AS post_id, ct.*, ua.*, up.profile_name, COALESCE(v.view_count, 0) AS post_views, COALESCE(c.comment_count, 0) AS post_comments, COALESCE(vo.vote_sum, 0) AS post_votes FROM cyo_topics ct INNER JOIN cyo_auth_accounts ua ON ct.user_id = ua.id INNER JOIN cyo_user_profiles up ON ua.id = up.auth_account_id LEFT JOIN (SELECT topic_id, COUNT(id) AS view_count FROM cyo_topic_views GROUP BY topic_id) v ON ct.id = v.topic_id LEFT JOIN (SELECT topic_id, COUNT(id) AS comment_count FROM cyo_topic_comments GROUP BY topic_id) c ON ct.id = c.topic_id LEFT JOIN (SELECT topic_id, SUM(vote_value) AS vote_sum FROM cyo_topic_votes GROUP BY topic_id) vo ON ct.id = vo.topic_id ORDER BY ct.created_at DESC");
        return $this->loadAllRows();
    }

    public function addNewPost() {}
}
