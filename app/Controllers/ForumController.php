<?php

namespace App\Controllers;

use App\Models\MainCategory;
use App\Models\Subforum;

class ForumController extends BaseController
{

    //Hiển thị danh sách các danh mục chính.
    public function index()
    {
        // Gọi model để lấy dữ liệu từ bảng main_categories
        $mainCategoryModel = new MainCategory();
        $mainCategories = $mainCategoryModel->getAllCategories();

        // Gửi dữ liệu qua view
        $this->render('forum.index', ['mainCategories' => $mainCategories]);
    }

    //Hiển thị danh sách các subforum thuộc danh mục chính.
    public function category($mainCategoryId)
    {
        // Gọi model để lấy danh mục chính
        $mainCategoryModel = new MainCategory();
        $mainCategory = $mainCategoryModel->getCategoryById($mainCategoryId);

        if (!$mainCategory) {
            echo "Danh mục không tồn tại.";
            return;
        }

        // Lấy danh sách các subforum thuộc danh mục chính
        $subforumModel = new Subforum();
        $subforums = $subforumModel->getSubforumsByMainCategoryId($mainCategoryId);

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
        $subforumModel = new Subforum();
        $subforum = $subforumModel->getSubforumById($subforumId);

        if (!$subforum) {
            echo "Subforum không tồn tại.";
            return;
        }

        // Gửi dữ liệu qua view
        $this->render('forum.subforum', ['subforum' => $subforum]);
    }
}
