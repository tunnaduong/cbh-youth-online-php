<?php

namespace App\Models;

class Profile extends BaseModel
{
    public function getProfile($username)
    {
        $uid = $_SESSION['user']->id ?? 0;

        $this->setQuery("SELECT ca.created_at AS joined_from, ca.id AS uid, ca.*, cu.*, cuc.*, cns.*, (SELECT COUNT(*) FROM cyo_topics WHERE user_id = ca.id) AS posts_count, (SELECT COUNT(*) FROM cyo_topic_votes WHERE topic_id IN (SELECT id FROM cyo_topics WHERE user_id = ca.id)) AS total_likes, (SELECT COUNT(*) FROM cyo_topic_comments WHERE user_id = ca.id) AS comments_count, ( (SELECT COUNT(*) FROM cyo_topics WHERE user_id = ca.id) * 10 + (SELECT COUNT(*) FROM cyo_topic_votes WHERE topic_id IN (SELECT id FROM cyo_topics WHERE user_id = ca.id)) * 5 + (SELECT COUNT(*) FROM cyo_topic_comments WHERE user_id = ca.id) * 2 ) AS total_points, (SELECT COUNT(*) FROM cyo_user_followers f WHERE f.followed_id = ca.id) AS total_followers, (SELECT COUNT(*) FROM cyo_user_followers f WHERE f.follower_id = ca.id) AS total_following, ( SELECT COUNT(*) FROM cyo_user_followers f WHERE f.followed_id = ca.id AND f.follower_id = $uid ) AS followed FROM cyo_auth_accounts ca INNER JOIN cyo_user_profiles cu ON ca.username = cu.profile_username LEFT JOIN cyo_cdn_user_content cuc ON cu.profile_picture = cuc.id LEFT JOIN cyo_notification_settings cns ON cns.user_id = ca.id WHERE ca.username = ?");
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
        $this->setQuery("SELECT user_points.id, user_points.username, total_points, ( SELECT COUNT(*) + 1 FROM cyo_auth_accounts AS ca2 WHERE ca2.role != 'admin' AND ( ( SELECT COUNT(*) FROM cyo_topics WHERE user_id = ca2.id ) * 10 +( SELECT COUNT(*) FROM cyo_topic_votes WHERE topic_id IN( SELECT id FROM cyo_topics WHERE user_id = ca2.id ) ) * 5 +( SELECT COUNT(*) FROM cyo_topic_comments WHERE user_id = ca2.id ) * 2 ) > total_points ) AS current_rank FROM ( SELECT ca.id, ca.username, ( ( SELECT COUNT(*) FROM cyo_topics WHERE user_id = ca.id ) * 10 +( SELECT COUNT(*) FROM cyo_topic_votes WHERE topic_id IN( SELECT id FROM cyo_topics WHERE user_id = ca.id ) ) * 5 +( SELECT COUNT(*) FROM cyo_topic_comments WHERE user_id = ca.id ) * 2 ) AS total_points FROM cyo_auth_accounts ca WHERE ca.role != 'admin' ) AS user_points WHERE user_points.id = ?");
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
                        a.email = ?, 
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
                    $data['email'],
                    date('Y-m-d H:i:s'),
                    date('Y-m-d H:i:s'),
                    $data['username'] !== $_SESSION['user']->username,
                    date('Y-m-d H:i:s'),
                    $_SESSION['user']->username
                ]);
                break;
            case "account_edit":
                $this->setQuery("UPDATE cyo_user_profiles SET profile_name = ?, birthday = ?, updated_at = ? WHERE profile_username = ?");
                $this->execute([$data['profile_name'], empty($data['birthday']) ? null : $data['birthday'], date('Y-m-d H:i:s'), $_SESSION['user']->username]);
                break;
            case "notification_edit":
                $this->setQuery("UPDATE cyo_notification_settings SET notify_type = ?, notify_email_contact = ?, notify_email_marketing = ?, notify_email_social = ?, notify_email_security = ?, updated_at = ? WHERE user_id = ?");
                $this->execute([$data['notify_type'] ?? "all", $data['notify_email_contact'], $data['notify_email_marketing'] ?? 0, $data['notify_email_social'], $data['notify_email_security'] ?? 1, date('Y-m-d H:i:s'), $_SESSION['user']->id]);
            case "remove_avatar":
                $this->setQuery("UPDATE cyo_user_profiles SET profile_picture = NULL, oauth_profile_picture = NULL, updated_at = ? WHERE profile_username = ?");
                $this->execute([date('Y-m-d H:i:s'), $_SESSION['user']->username]);
                break;
        }
    }

    public function removeAvatar($username)
    {
        $this->setQuery("UPDATE cyo_user_profiles SET profile_picture = NULL, oauth_profile_picture = NULL, updated_at = ? WHERE profile_username = ?");
        $this->execute([date('Y-m-d H:i:s'), $username]);
    }

    public function getFollowing($userId)
    {
        $this->setQuery("SELECT 
                            ca.id AS uid, 
                            ca.username, 
                            p.*, 
                            u.file_path AS avatar, 
                            (SELECT COUNT(*) FROM cyo_user_followers f WHERE f.followed_id = ca.id) AS total_followers, 
                            (SELECT COUNT(*) FROM cyo_user_followers f WHERE f.follower_id = ca.id) AS total_following, 
                            CASE 
                                WHEN EXISTS (
                                    SELECT 1 
                                    FROM cyo_user_followers 
                                    WHERE follower_id = ? AND followed_id = ca.id
                                ) THEN 1 
                                ELSE 0 
                            END AS followed
                        FROM 
                            cyo_auth_accounts ca
                        INNER JOIN 
                            cyo_user_followers f ON ca.id = f.followed_id
                        LEFT JOIN 
                            cyo_user_profiles p ON ca.id = p.auth_account_id
                        LEFT JOIN 
                            cyo_cdn_user_content u ON p.profile_picture = u.id
                        WHERE 
                            f.follower_id = ? ORDER BY f.created_at DESC");
        return $this->loadAllRows([$_SESSION['user']->id ?? 0, $userId]);
    }

    public function getFollowers($userId)
    {
        $this->setQuery("SELECT 
                            ca.id AS uid, 
                            ca.username, 
                            p.*, 
                            u.file_path AS avatar, 
                            (SELECT COUNT(*) FROM cyo_user_followers f WHERE f.followed_id = ca.id) AS total_followers, 
                            (SELECT COUNT(*) FROM cyo_user_followers f WHERE f.follower_id = ca.id) AS total_following, 
                            CASE 
                                WHEN EXISTS (
                                    SELECT 1 
                                    FROM cyo_user_followers 
                                    WHERE follower_id = ? AND followed_id = ca.id
                                ) THEN 1 
                                ELSE 0 
                            END AS followed
                        FROM 
                            cyo_auth_accounts ca
                        INNER JOIN 
                            cyo_user_followers f ON ca.id = f.follower_id
                        LEFT JOIN 
                            cyo_user_profiles p ON ca.id = p.auth_account_id
                        LEFT JOIN 
                            cyo_cdn_user_content u ON p.profile_picture = u.id
                        WHERE 
                            f.followed_id = ? ORDER BY f.created_at DESC");
        return $this->loadAllRows([$_SESSION['user']->id ?? 0, $userId]);
    }

    public function getLastUsernameChange($username)
    {
        $this->setQuery("SELECT last_username_change FROM cyo_user_profiles WHERE profile_username = ?");
        return $this->loadRow([$username]);
    }
}
