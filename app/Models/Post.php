<?php

namespace App\Models;

use App\Models\BaseModel;

class Post extends BaseModel
{
    public function newsfeed()
    {
        $uid = $_SESSION['user']->id ?? 0;
        $this->setQuery("SELECT ct.created_at AS post_created_at, ct.id AS post_id, ct.*, ua.*, up.profile_name, up.verified, COALESCE(v.view_count, 0) AS post_views, COALESCE(c.comment_count, 0) AS post_comments, COALESCE(vo.vote_sum, 0) AS post_votes, ccu.file_path, cup.profile_picture, cup.oauth_profile_picture, CASE WHEN uv.vote_value = 1 THEN 'upvote' WHEN uv.vote_value = -1 THEN 'downvote' ELSE 'none' END AS user_vote, CASE WHEN ust.topic_id IS NOT NULL THEN 1 ELSE 0 END AS is_saved FROM cyo_topics ct INNER JOIN cyo_auth_accounts ua ON ct.user_id = ua.id INNER JOIN cyo_user_profiles up ON ua.id = up.auth_account_id LEFT JOIN (SELECT topic_id, COUNT(id) AS view_count FROM cyo_topic_views GROUP BY topic_id) v ON ct.id = v.topic_id LEFT JOIN (SELECT topic_id, COUNT(id) AS comment_count FROM cyo_topic_comments GROUP BY topic_id) c ON ct.id = c.topic_id LEFT JOIN (SELECT topic_id, SUM(vote_value) AS vote_sum FROM cyo_topic_votes GROUP BY topic_id) vo ON ct.id = vo.topic_id LEFT JOIN cyo_cdn_user_content ccu ON ct.cdn_image_id = ccu.id LEFT JOIN cyo_topic_votes uv ON ct.id = uv.topic_id AND uv.user_id = $uid LEFT JOIN cyo_user_profiles cup ON ua.id = cup.auth_account_id LEFT JOIN cyo_user_saved_topics ust ON ust.user_id = $uid AND ust.topic_id = ct.id WHERE hidden = 0 ORDER BY ct.created_at DESC");
        return $this->loadAllRows();
    }

    public function addNewPost()
    {
        $this->setQuery("INSERT INTO cyo_topics (user_id, subforum_id, title, description, created_at, updated_at, cdn_image_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
        // die(var_dump($_POST));
        $this->execute([
            $_SESSION['user']->id,
            $_POST['subforumId'],
            $_POST['title'],
            $_POST['content'],
            date('Y-m-d H:i:s'),
            date('Y-m-d H:i:s'),
            $_POST['imageId'] ?? null
        ]);
    }

    public function incrementViewCount($postId)
    {
        // Increment the view count for the specific post
        $this->setQuery("INSERT INTO cyo_topic_views (topic_id, user_id, created_at, updated_at) VALUES (?, ?, ?, ?)");
        return $this->execute([$postId, $_SESSION['user']->id ?? NULL, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
    }

    public function getPostDetail($postId)
    {
        $uid = $_SESSION['user']->id ?? 0;
        $this->setQuery("SELECT ct.created_at AS post_created_at, ct.id AS post_id, ct.*, ua.*, up.profile_name, up.verified, COALESCE(v.view_count, 0) AS post_views, COALESCE(c.comment_count, 0) AS post_comments, COALESCE(vo.vote_sum, 0) AS post_votes, ccu.file_path, cup.profile_picture, cup.oauth_profile_picture, CASE WHEN uv.vote_value = 1 THEN 'upvote' WHEN uv.vote_value = -1 THEN 'downvote' ELSE 'none' END AS user_vote, CASE WHEN ust.topic_id IS NOT NULL THEN 1 ELSE 0 END AS is_saved FROM cyo_topics ct INNER JOIN cyo_auth_accounts ua ON ct.user_id = ua.id INNER JOIN cyo_user_profiles up ON ua.id = up.auth_account_id LEFT JOIN (SELECT topic_id, COUNT(id) AS view_count FROM cyo_topic_views GROUP BY topic_id) v ON ct.id = v.topic_id LEFT JOIN (SELECT topic_id, COUNT(id) AS comment_count FROM cyo_topic_comments GROUP BY topic_id) c ON ct.id = c.topic_id LEFT JOIN (SELECT topic_id, SUM(vote_value) AS vote_sum FROM cyo_topic_votes GROUP BY topic_id) vo ON ct.id = vo.topic_id LEFT JOIN cyo_cdn_user_content ccu ON ct.cdn_image_id = ccu.id LEFT JOIN cyo_topic_votes uv ON ct.id = uv.topic_id AND uv.user_id = $uid LEFT JOIN cyo_user_profiles cup ON ua.id = cup.auth_account_id LEFT JOIN cyo_user_saved_topics ust ON ust.user_id = $uid AND ust.topic_id = ct.id WHERE ct.id = $postId ORDER BY ct.created_at DESC");
        return $this->loadRow();
    }

    public function getComments($postId)
    {
        $uid = $_SESSION['user']->id ?? 0;
        $this->setQuery("SELECT ctc.created_at AS comment_created_at, ctc.id AS comment_id, ctc.*, ua.*, up.profile_name, up.verified, cup.profile_picture, cup.oauth_profile_picture, COALESCE(vo.vote_sum, 0) AS comment_votes, CASE WHEN tcv.vote_value = 1 THEN 'upvote' WHEN tcv.vote_value = -1 THEN 'downvote' ELSE 'none' END AS user_vote FROM cyo_topic_comments ctc INNER JOIN cyo_auth_accounts ua ON ctc.user_id = ua.id INNER JOIN cyo_user_profiles up ON ua.id = up.auth_account_id LEFT JOIN cyo_user_profiles cup ON ua.id = cup.auth_account_id LEFT JOIN cyo_topic_comment_votes tcv ON ctc.id = tcv.comment_id AND tcv.user_id = $uid LEFT JOIN ( SELECT comment_id, SUM(vote_value) AS vote_sum FROM cyo_topic_comment_votes GROUP BY comment_id ) vo ON ctc.id = vo.comment_id WHERE ctc.topic_id = ? ORDER BY ctc.created_at DESC");
        return $this->loadAllRows([$postId]);
    }

    public function addNewComment($postId)
    {
        $this->setQuery("INSERT INTO cyo_topic_comments (replying_to, topic_id, user_id, comment, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)");
        $this->execute([
            $_POST['replyingTo'] ?? null,
            $postId,
            $_SESSION['user']->id,
            $_POST['comment'],
            date('Y-m-d H:i:s'),
            date('Y-m-d H:i:s')
        ]);
    }

    public function getPostsByUser($userId)
    {
        $uid = $_SESSION['user']->id ?? 0;
        $this->setQuery("SELECT ct.created_at AS post_created_at, ct.id AS post_id, ct.*, ua.*, up.profile_name, up.verified, COALESCE(v.view_count, 0) AS post_views, COALESCE(c.comment_count, 0) AS post_comments, COALESCE(vo.vote_sum, 0) AS post_votes, ccu.file_path, cup.profile_picture, cup.oauth_profile_picture, CASE WHEN uv.vote_value = 1 THEN 'upvote' WHEN uv.vote_value = -1 THEN 'downvote' ELSE 'none' END AS user_vote, CASE WHEN ust.topic_id IS NOT NULL THEN 1 ELSE 0 END AS is_saved FROM cyo_topics ct INNER JOIN cyo_auth_accounts ua ON ct.user_id = ua.id INNER JOIN cyo_user_profiles up ON ua.id = up.auth_account_id LEFT JOIN (SELECT topic_id, COUNT(id) AS view_count FROM cyo_topic_views GROUP BY topic_id) v ON ct.id = v.topic_id LEFT JOIN (SELECT topic_id, COUNT(id) AS comment_count FROM cyo_topic_comments GROUP BY topic_id) c ON ct.id = c.topic_id LEFT JOIN (SELECT topic_id, SUM(vote_value) AS vote_sum FROM cyo_topic_votes GROUP BY topic_id) vo ON ct.id = vo.topic_id LEFT JOIN cyo_cdn_user_content ccu ON ct.cdn_image_id = ccu.id LEFT JOIN cyo_topic_votes uv ON ct.id = uv.topic_id AND uv.user_id = $uid LEFT JOIN cyo_user_profiles cup ON ua.id = cup.auth_account_id LEFT JOIN cyo_user_saved_topics ust ON ust.user_id = $uid AND ust.topic_id = ct.id WHERE ct.user_id = ? ORDER BY ct.created_at DESC");
        return $this->loadAllRows([$userId]);
    }

    public function saved()
    {
        $uid = $_SESSION['user']->id ?? 0;
        $this->setQuery("SELECT ct.created_at AS post_created_at, ct.id AS post_id, ct.*, ua.*, up.profile_name, up.verified, COALESCE(v.view_count, 0) AS post_views, COALESCE(c.comment_count, 0) AS post_comments, COALESCE(vo.vote_sum, 0) AS post_votes, ccu.file_path, cup.profile_picture, cup.oauth_profile_picture, CASE WHEN uv.vote_value = 1 THEN 'upvote' WHEN uv.vote_value = -1 THEN 'downvote' ELSE 'none' END AS user_vote, CASE WHEN ust.topic_id IS NOT NULL THEN 1 ELSE 0 END AS is_saved FROM cyo_topics ct INNER JOIN cyo_auth_accounts ua ON ct.user_id = ua.id INNER JOIN cyo_user_profiles up ON ua.id = up.auth_account_id LEFT JOIN (SELECT topic_id, COUNT(id) AS view_count FROM cyo_topic_views GROUP BY topic_id) v ON ct.id = v.topic_id LEFT JOIN (SELECT topic_id, COUNT(id) AS comment_count FROM cyo_topic_comments GROUP BY topic_id) c ON ct.id = c.topic_id LEFT JOIN (SELECT topic_id, SUM(vote_value) AS vote_sum FROM cyo_topic_votes GROUP BY topic_id) vo ON ct.id = vo.topic_id LEFT JOIN cyo_cdn_user_content ccu ON ct.cdn_image_id = ccu.id LEFT JOIN cyo_topic_votes uv ON ct.id = uv.topic_id AND uv.user_id = $uid LEFT JOIN cyo_user_profiles cup ON ua.id = cup.auth_account_id LEFT JOIN cyo_user_saved_topics ust ON ust.user_id = $uid AND ust.topic_id = ct.id WHERE ust.user_id = $uid ORDER BY ust.created_at DESC");
        return $this->loadAllRows();
    }

    public function youthNews()
    {
        $uid = $_SESSION['user']->id ?? 0;
        $this->setQuery("SELECT ct.created_at AS post_created_at, ct.id AS post_id, ct.*, ua.*, up.profile_name, up.verified, COALESCE(v.view_count, 0) AS post_views, COALESCE(c.comment_count, 0) AS post_comments, COALESCE(vo.vote_sum, 0) AS post_votes, ccu.file_path, cup.profile_picture, cup.oauth_profile_picture, CASE WHEN uv.vote_value = 1 THEN 'upvote' WHEN uv.vote_value = -1 THEN 'downvote' ELSE 'none' END AS user_vote, CASE WHEN ust.topic_id IS NOT NULL THEN 1 ELSE 0 END AS is_saved FROM cyo_topics ct INNER JOIN cyo_auth_accounts ua ON ct.user_id = ua.id INNER JOIN cyo_user_profiles up ON ua.id = up.auth_account_id LEFT JOIN (SELECT topic_id, COUNT(id) AS view_count FROM cyo_topic_views GROUP BY topic_id) v ON ct.id = v.topic_id LEFT JOIN (SELECT topic_id, COUNT(id) AS comment_count FROM cyo_topic_comments GROUP BY topic_id) c ON ct.id = c.topic_id LEFT JOIN (SELECT topic_id, SUM(vote_value) AS vote_sum FROM cyo_topic_votes GROUP BY topic_id) vo ON ct.id = vo.topic_id LEFT JOIN cyo_cdn_user_content ccu ON ct.cdn_image_id = ccu.id LEFT JOIN cyo_topic_votes uv ON ct.id = uv.topic_id AND uv.user_id = $uid LEFT JOIN cyo_user_profiles cup ON ua.id = cup.auth_account_id LEFT JOIN cyo_user_saved_topics ust ON ust.user_id = $uid AND ust.topic_id = ct.id WHERE ct.subforum_id = 32 AND hidden = 0 ORDER BY ct.created_at DESC");
        return $this->loadAllRows();
    }
}
