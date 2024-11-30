<?php

namespace App\Models;

use PDO;

class Forum extends BaseModel
{
    // Lấy thông tin chi tiết danh mục dựa trên ID
    public function getCategoryBySlug($slug)
    {
        $this->setQuery("SELECT * FROM cyo_forum_main_categories WHERE slug = ?");
        return $this->loadRow([$slug]);
    }

    // Lấy danh sách tất cả danh mục
    public function getCategories()
    {
        $this->setQuery("SELECT * FROM cyo_forum_main_categories");
        return $this->loadAllRows();
    }

    // Lấy thông tin diễn đàn con (subforum) dựa trên ID
    public function getSubforumBySlug($slug)
    {
        $this->setQuery("SELECT * FROM cyo_forum_subforums WHERE slug = ?");
        return $this->loadRow([$slug]);
    }

    public function getSubforumsByMainCategoryId($categoryId)
    {
        $this->setQuery("SELECT s.*, c.name as category_name FROM cyo_forum_subforums s INNER JOIN cyo_forum_main_categories c ON s.main_category_id = c.id WHERE s.main_category_id = ?");

        return $this->loadAllRows([$categoryId]);
    }

    public function getSubforumsByMainCategorySlug($slug)
    {
        $this->setQuery("SELECT s.*, c.name as category_name FROM cyo_forum_subforums s INNER JOIN cyo_forum_main_categories c ON s.main_category_id = c.id WHERE c.slug = ?");

        return $this->loadAllRows([$slug]);
    }

    // Lấy danh sách tất cả diễn đàn con
    public function getSubforums()
    {
        $this->setQuery("SELECT * FROM cyo_forum_subforums");
        return $this->loadAllRows();
    }

    // Đếm số bài viết trong một danh mục
    public function getPostCount($subforumId)
    {
        $this->setQuery("SELECT COUNT(*) FROM cyo_topics WHERE subforum_id = ?");
        return $this->loadRecord([$subforumId]);
    }

    // Đếm số bình luận trong một danh mục
    public function getCommentCount($subforumId)
    {
        $this->setQuery("SELECT COUNT(*) FROM cyo_topic_comments WHERE topic_id IN (SELECT id FROM cyo_topics WHERE subforum_id = ?)");
        return $this->loadRecord([$subforumId]);
    }

    // Lấy bài viết mới nhất trong một danh mục
    public function getLatestPost($subforumId)
    {
        $this->setQuery("SELECT *, ct.created_at AS post_created_at, ct.id AS post_id FROM cyo_topics ct LEFT JOIN cyo_auth_accounts ca ON ct.user_id = ca.id LEFT JOIN cyo_user_profiles cu ON ca.username = cu.profile_username WHERE subforum_id = ? ORDER BY ct.created_at DESC LIMIT 1");
        return $this->loadRow([$subforumId]);
    }

    // Lấy toàn bộ bài viết từ một subforum bằng ID
    public function getTopicsBySubforumId($subforumId)
    {
        $this->setQuery("SELECT *, ct.created_at AS post_created_at, ct.id AS post_id FROM cyo_topics ct LEFT JOIN cyo_auth_accounts ca ON ct.user_id = ca.id LEFT JOIN cyo_user_profiles cu ON ca.username = cu.profile_username WHERE subforum_id = ? ORDER BY ct.created_at DESC");
        return $this->loadAllRows([$subforumId]);
    }

    // Đếm số bình luận trong một bài viết
    public function getCommentCountByTopicId($topicId)
    {
        $this->setQuery("SELECT COUNT(*) FROM cyo_topic_comments WHERE topic_id = ?");
        return $this->loadRecord([$topicId]);
    }

    // Đếm số lượt xem của một bài viết qua bảng cyo_topic_views
    public function getViewsCountByTopicId($topicId)
    {
        $this->setQuery("SELECT COUNT(*) FROM cyo_topic_views WHERE topic_id = ?");
        return $this->loadRecord([$topicId]);
    }

    // Lấy bình luận mới nhất trong một bài viết
    public function getLatestCommentByTopicId($topicId)
    {
        $this->setQuery("SELECT *, ctc.created_at AS comment_created_at FROM cyo_topic_comments ctc LEFT JOIN cyo_auth_accounts ca ON ctc.user_id = ca.id LEFT JOIN cyo_user_profiles cu ON ca.username = cu.profile_username WHERE topic_id = ? ORDER BY ctc.created_at DESC LIMIT 1");
        return $this->loadRow([$topicId]);
    }
}
