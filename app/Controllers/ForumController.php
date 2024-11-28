<?php

namespace App\Controllers;

use App\Models\Forum;
use App\Models\Subforum;
use App\Models\MainCategory;

class ForumController extends BaseController
{
    protected $forumModel;

    public function __construct()
    {
        $this->forumModel = new Forum();
    }

    //Hiển thị danh sách các danh mục chính.
    public function index()
    {
        // Gọi model để lấy dữ liệu từ bảng main_categories
        $mainCategories = $this->forumModel->getCategories();

        // Gửi dữ liệu qua view
        $this->render('forum.index', ['mainCategories' => $mainCategories]);
    }

    //Hiển thị danh sách các subforum thuộc danh mục chính.
    public function category($mainCategoryId)
    {
        // Gọi model để lấy danh mục chính
        $mainCategory = $this->forumModel->getCategoryById($mainCategoryId);

        if (!$mainCategory) {
            echo "Danh mục không tồn tại.";
            return;
        }

        // Lấy danh sách các subforum thuộc danh mục chính
        $subforums = $this->forumModel->getSubforumsByMainCategoryId($mainCategoryId);

        // Gửi dữ liệu qua view
        $this->render('forum.category', [
            'mainCategory' => $mainCategory,
            'subforums' => $subforums,
        ]);
    }

    //Hiển thị thông tin chi tiết của subforum.
    public function subforum($subforumId)
    {
        // Gọi model để lấy subforum
        $subforum = $this->forumModel->getSubforumById($subforumId);

        if (!$subforum) {
            echo "Subforum không tồn tại.";
            return;
        }

        // Gửi dữ liệu qua view
        $this->render('forum.subforum', ['subforum' => $subforum]);
    }
}
