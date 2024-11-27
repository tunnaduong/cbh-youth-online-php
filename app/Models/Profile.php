<?php

namespace App\Models;

class Profile extends BaseModel
{
    public function getProfile($username)
    {
        $this->setQuery("SELECT ca.created_at AS joined_from, ca.id AS uid, ca.*, cu.*, cuc.*, (SELECT COUNT(*) FROM cyo_topics WHERE user_id = ca.id) AS posts_count, (SELECT COUNT(*) FROM cyo_topic_votes WHERE topic_id IN (SELECT id FROM cyo_topics WHERE user_id = ca.id)) AS total_likes, (SELECT COUNT(*) FROM cyo_topic_comments WHERE user_id = ca.id) AS comments_count, ( (SELECT COUNT(*) FROM cyo_topics WHERE user_id = ca.id) * 10 + (SELECT COUNT(*) FROM cyo_topic_votes WHERE topic_id IN (SELECT id FROM cyo_topics WHERE user_id = ca.id)) * 5 + (SELECT COUNT(*) FROM cyo_topic_comments WHERE user_id = ca.id) * 2 ) AS total_points, (SELECT COUNT(*) FROM cyo_user_followers f WHERE f.followed_id = ca.id) AS total_followers, (SELECT COUNT(*) FROM cyo_user_followers f WHERE f.follower_id = ca.id) AS total_following FROM cyo_auth_accounts ca INNER JOIN cyo_user_profiles cu ON ca.username = cu.profile_username LEFT JOIN cyo_cdn_user_content cuc ON cu.profile_picture = cuc.id WHERE ca.username = ?");
        return $this->loadRow([$username]);
    }
}
