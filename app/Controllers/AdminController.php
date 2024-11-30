<?php


namespace App\Controllers;

use App\Models\Admin;

class AdminController extends BaseController
{
    private $adminModel;

    public function __construct()
    {
        $this->adminModel = new Admin();
    }

    // Trang chính của Admin
    public function index()
    {
        // Nếu không phải admin thì quay về trang chủ
        if (!isset($_SESSION['user']) || $_SESSION['user']->role !== 'admin') {
            header('Location: /login');
            exit;
        }

        $users = $this->adminModel->getAllUsers();
        $posts = $this->adminModel->getAllPosts();

        $this->render('admin.admin_dashboard', [
            'users' => $users,
            'posts' => $posts
        ]);
    }

    // // Quản lý danh mục
    // public function manageCategories()
    // {
    //     $categories = $this->adminModel->getCategories();
    //     $this->render('admin.categories', ['categories' => $categories]);
    // }

    // // Thêm danh mục mới
    // public function addCategory()
    // {
    //     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //         $name = $_POST['name'];
    //         $description = $_POST['description'];

    //         $this->adminModel->setQuery("INSERT INTO categories (name, description) VALUES (?, ?)");
    //         $this->adminModel->execute([$name, $description]);

    //         header('Location: /admin/categories');
    //     } else {
    //         $this->render('admin.add_category');
    //     }
    // }

    // // Quản lý bài viết trong danh mục
    // public function managePosts($categoryId)
    // {
    //     $posts = $this->adminModel->getPostCount($categoryId); // Tuỳ chỉnh hàm nếu cần chi tiết hơn
    //     $this->render('admin.posts', ['posts' => $posts, 'categoryId' => $categoryId]);
    // }

    // // Xoá danh mục
    // public function deleteCategory($id)
    // {
    //     $this->adminModel->setQuery("DELETE FROM categories WHERE id = ?");
    //     $this->adminModel->execute([$id]);

    //     header('Location: /admin/categories');
    // }

    // // Hiển thị bình luận theo danh mục
    // public function viewComments($categoryId)
    // {
    //     $comments = $this->adminModel->loadAllRows(["SELECT * FROM comments WHERE category_id = ?", [$categoryId]]);
    //     $this->render('admin.comments', ['comments' => $comments]);
    // }
}
