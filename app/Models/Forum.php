<?php

namespace App\Models;

use PDO;

class Forum extends BaseModel
{
    // Lấy thông tin chi tiết danh mục dựa trên ID
    public function getCategoryById($id)
    {
        $this->setQuery("SELECT * FROM categories WHERE id = ?");
        return $this->loadRow([$id]);
    }

    // Lấy danh sách tất cả danh mục
    public function getCategories()
    {
        $this->setQuery("SELECT * FROM categories");
        return $this->loadAllRows();
    }

    // Lấy thông tin diễn đàn con (subforum) dựa trên ID
    public function getSubforumById($id)
    {
        $this->setQuery("SELECT * FROM subforums WHERE id = ?");
        return $this->loadRow([$id]);
    }

    public function getSubforumsByMainCategoryId($categoryId)
    {
        $this->setQuery("SELECT s.*, c.name as category_name FROM subforums sINNER JOIN categories  ON s.category_id = c.id WHERE s.category_id = ?");

        return $this->loadAllRows([$categoryId]);
    }

    // Lấy danh sách tất cả diễn đàn con
    public function getSubforums()
    {
        $this->setQuery("SELECT * FROM subforums");
        return $this->loadAllRows();
    }

    // Đếm số bài viết trong một danh mục
    public function getPostCount($categoryId)
    {
        $this->setQuery("SELECT COUNT(*) FROM posts WHERE category_id = ?");
        return $this->loadRecord([$categoryId]);
    }

    // Đếm số bình luận trong một danh mục
    public function getCommentCount($categoryId)
    {
        $this->setQuery("SELECT COUNT(*) FROM comments WHERE category_id = ?");
        return $this->loadRecord([$categoryId]);
    }

    // Lấy bài viết mới nhất trong một danh mục
    public function getLatestPost($categoryId)
    {
        $this->setQuery("SELECT * FROM posts WHERE category_id = ? ORDER BY created_at DESC LIMIT 1");
        return $this->loadRow([$categoryId]);
    }
}
