<?php

namespace App\Models;

class Profile extends BaseModel
{
    public function getProfile($username)
    {
        $uid = $_SESSION['user']->id ?? 0;

        $this->setQuery("SELECT ca.created_at AS joined_from, ca.id AS uid, ca.*, cu.*, cuc.*, (SELECT COUNT(*) FROM cyo_topics WHERE user_id = ca.id) AS posts_count, (SELECT COUNT(*) FROM cyo_topic_votes WHERE topic_id IN (SELECT id FROM cyo_topics WHERE user_id = ca.id)) AS total_likes, (SELECT COUNT(*) FROM cyo_topic_comments WHERE user_id = ca.id) AS comments_count, ( (SELECT COUNT(*) FROM cyo_topics WHERE user_id = ca.id) * 10 + (SELECT COUNT(*) FROM cyo_topic_votes WHERE topic_id IN (SELECT id FROM cyo_topics WHERE user_id = ca.id)) * 5 + (SELECT COUNT(*) FROM cyo_topic_comments WHERE user_id = ca.id) * 2 ) AS total_points, (SELECT COUNT(*) FROM cyo_user_followers f WHERE f.followed_id = ca.id) AS total_followers, (SELECT COUNT(*) FROM cyo_user_followers f WHERE f.follower_id = ca.id) AS total_following, ( SELECT COUNT(*) FROM cyo_user_followers f WHERE f.followed_id = ca.id AND f.follower_id = $uid ) AS followed FROM cyo_auth_accounts ca INNER JOIN cyo_user_profiles cu ON ca.username = cu.profile_username LEFT JOIN cyo_cdn_user_content cuc ON cu.profile_picture = cuc.id WHERE ca.username = ?");
        return $this->loadRow([$username]);
    }

    public function getTop8ActiveUsers()
    {
        // get top 8 active users other than admin
        $this->setQuery("SELECT ca.id AS uid, ca.username, cu.profile_name, cuc.file_path AS profile_picture, cu.oauth_profile_picture, (SELECT COUNT(*) FROM cyo_topics WHERE user_id = ca.id) AS posts_count, (SELECT COUNT(*) FROM cyo_topic_votes WHERE topic_id IN (SELECT id FROM cyo_topics WHERE user_id = ca.id)) AS total_likes, (SELECT COUNT(*) FROM cyo_topic_comments WHERE user_id = ca.id) AS comments_count, ( (SELECT COUNT(*) FROM cyo_topics WHERE user_id = ca.id) * 10 + (SELECT COUNT(*) FROM cyo_topic_votes WHERE topic_id IN (SELECT id FROM cyo_topics WHERE user_id = ca.id)) * 5 + (SELECT COUNT(*) FROM cyo_topic_comments WHERE user_id = ca.id) * 2 ) AS total_points FROM cyo_auth_accounts ca INNER JOIN cyo_user_profiles cu ON ca.username = cu.profile_username LEFT JOIN cyo_cdn_user_content cuc ON cu.profile_picture = cuc.id WHERE ca.role != 'admin' ORDER BY total_points DESC LIMIT 8");
        return $this->loadAllRows();
    }

    public function getCurrentUserRank()
    {
        $this->setQuery("SELECT user_points.id, user_points.username, total_points, ( SELECT COUNT(*) + 1 FROM cyo_auth_accounts AS ca2 WHERE ( (SELECT COUNT(*) FROM cyo_topics WHERE user_id = ca2.id) * 10 + (SELECT COUNT(*) FROM cyo_topic_votes WHERE topic_id IN (SELECT id FROM cyo_topics WHERE user_id = ca2.id)) * 5 + (SELECT COUNT(*) FROM cyo_topic_comments WHERE user_id = ca2.id) * 2 ) > total_points ) AS current_rank FROM ( SELECT ca.id, ca.username, ( (SELECT COUNT(*) FROM cyo_topics WHERE user_id = ca.id) * 10 + (SELECT COUNT(*) FROM cyo_topic_votes WHERE topic_id IN (SELECT id FROM cyo_topics WHERE user_id = ca.id)) * 5 + (SELECT COUNT(*) FROM cyo_topic_comments WHERE user_id = ca.id) * 2 ) AS total_points FROM cyo_auth_accounts ca ) AS user_points WHERE user_points.id = ?");
        return $this->loadRow([$_SESSION['user']->id ?? null]);
    }

    public function updateProfile($data)
    {
        // die(var_dump($data));
        switch ($data['type']) {
            case "profile_edit":
                $this->setQuery("
                    UPDATE cyo_user_profiles p
                    INNER JOIN cyo_auth_accounts a ON p.auth_account_id = a.id
                    SET 
                        p.profile_username = ?, 
                        p.bio = ?, 
                        p.gender = ?, 
                        p.location = ?, 
                        a.username = ?, 
                        p.updated_at = ?, 
                        a.updated_at = ?, 
                        p.last_username_change = CASE WHEN ? THEN ? ELSE p.last_username_change END
                    WHERE profile_username = ?
                ");
                $this->execute([
                    $data['username'],
                    $data['bio'] ?? null,
                    $data['gender'] ?? null,
                    $data['location'] ?? null,
                    $data['username'],
                    date('Y-m-d H:i:s'),
                    date('Y-m-d H:i:s'),
                    $data['username'] !== $_SESSION['user']->username,
                    date('Y-m-d H:i:s'),
                    $_SESSION['user']->username
                ]);
                break;
            case "account_edit":
                $this->setQuery("UPDATE cyo_user_profiles SET profile_name = ?, birthday = ? WHERE profile_username = ?");
                $this->execute([$data['profile_name'], $data['birthday'] ?? null, $_SESSION['user']->username]);
                break;
        }
    }

    public function getLastUsernameChange($username)
    {
        $this->setQuery("SELECT last_username_change FROM cyo_user_profiles WHERE profile_username = ?");
        return $this->loadRow([$username]);
    }
}
