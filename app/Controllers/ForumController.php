<?php

namespace App\Controllers;

use App\Models\Forum;

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

        // Lấy danh sách các subforum thuộc tất cả các danh mục chính
        foreach ($mainCategories as $category) {
            $category->subforums = $this->forumModel->getSubforumsByMainCategoryId($category->id);
            foreach ($category->subforums as $subforum) {
                $subforum->posts_count = $this->forumModel->getPostCount($subforum->id);
                $subforum->comments_count = $this->forumModel->getCommentCount($subforum->id);
                $subforum->latest_post = $this->forumModel->getLatestPost($subforum->id);
            }
        }

        // Gửi dữ liệu qua view
        return $this->render('forum.index', [
            'mainCategories' => $mainCategories,
        ]);
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
