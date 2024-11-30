<?php


namespace App\Controllers;

use App\Models\Forum;

class AdminController extends BaseController
{
    private $forumModel;

    public function __construct()
    {
        $this->forumModel = new Forum();
    }

    // Trang chính của Admin
    public function index()
    {
        $categories = $this->forumModel->getCategories();
        $subforums = $this->forumModel->getSubforums();

        $this->render('admin.dashboard', [
            'categories' => $categories,
            'subforums' => $subforums
        ]);
    }

    // Quản lý danh mục
    public function manageCategories()
    {
        $categories = $this->forumModel->getCategories();
        $this->render('admin.categories', ['categories' => $categories]);
    }

    // Thêm danh mục mới
    public function addCategory()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $description = $_POST['description'];

            $this->forumModel->setQuery("INSERT INTO categories (name, description) VALUES (?, ?)");
            $this->forumModel->execute([$name, $description]);

            header('Location: /admin/categories');
        } else {
            $this->render('admin.add_category');
        }
    }

    // Quản lý bài viết trong danh mục
    public function managePosts($categoryId)
    {
        $posts = $this->forumModel->getPostCount($categoryId); // Tuỳ chỉnh hàm nếu cần chi tiết hơn
        $this->render('admin.posts', ['posts' => $posts, 'categoryId' => $categoryId]);
    }

    // Xoá danh mục
    public function deleteCategory($id)
    {
        $this->forumModel->setQuery("DELETE FROM categories WHERE id = ?");
        $this->forumModel->execute([$id]);

        header('Location: /admin/categories');
    }

    // Hiển thị bình luận theo danh mục
    public function viewComments($categoryId)
    {
        $comments = $this->forumModel->loadAllRows(["SELECT * FROM comments WHERE category_id = ?", [$categoryId]]);
        $this->render('admin.comments', ['comments' => $comments]);
    }
}
?>