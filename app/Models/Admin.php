<?phP


namespace App\Models;

class Admin extends BaseModel
{
    // Lấy danh sách tất cả danh mục
    public function getAllCategories()
    {
        $this->setQuery("SELECT * FROM categories");
        return $this->loadAllRows();
    }

    // Lấy danh mục theo ID
    public function getCategoryById($id)
    {
        $this->setQuery("SELECT * FROM categories WHERE id = ?");
        return $this->loadRow([$id]);
    }

    // Thêm danh mục mới
    public function addCategory($name, $description)
    {
        $this->setQuery("INSERT INTO categories (name, description) VALUES (?, ?)");
        return $this->execute([$name, $description]);
    }

    // Cập nhật danh mục
    public function updateCategory($id, $name, $description)
    {
        $this->setQuery("UPDATE categories SET name = ?, description = ? WHERE id = ?");
        return $this->execute([$name, $description, $id]);
    }

    // Xóa danh mục
    public function deleteCategory($id)
    {
        $this->setQuery("DELETE FROM categories WHERE id = ?");
        return $this->execute([$id]);
    }

    // Lấy tất cả bài viết
    public function getAllPosts()
    {
        $this->setQuery("SELECT * FROM cyo_topics");
        return $this->loadAllRows();
    }

    // Lấy bài viết theo ID
    public function getPostById($id)
    {
        $this->setQuery("SELECT * FROM posts WHERE id = ?");
        return $this->loadRow([$id]);
    }

    // Lấy số lượng bài viết trong danh mục
    public function getPostCountByCategory($categoryId)
    {
        $this->setQuery("SELECT COUNT(*) FROM posts WHERE category_id = ?");
        return $this->loadRecord([$categoryId]);
    }

    // Lấy tất cả bình luận
    public function getAllComments()
    {
        $this->setQuery("SELECT * FROM comments");
        return $this->loadAllRows();
    }

    // Xóa bình luận theo ID
    public function deleteComment($id)
    {
        $this->setQuery("DELETE FROM comments WHERE id = ?");
        return $this->execute([$id]);
    }

    // Lấy thông tin diễn đàn con
    public function getAllSubforums()
    {
        $this->setQuery("SELECT * FROM subforums");
        return $this->loadAllRows();
    }

    // Thêm diễn đàn con
    public function addSubforum($name, $categoryId)
    {
        $this->setQuery("INSERT INTO subforums (name, category_id) VALUES (?, ?)");
        return $this->execute([$name, $categoryId]);
    }

    // Xóa diễn đàn con
    public function deleteSubforum($id)
    {
        $this->setQuery("DELETE FROM subforums WHERE id = ?");
        return $this->execute([$id]);
    }

    // Lấy dữ liệu người dùng
    public function getAllUsers()
    {
        $this->setQuery("SELECT * FROM cyo_auth_accounts");
        return $this->loadAllRows();
    }
}
