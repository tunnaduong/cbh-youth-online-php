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

        $latestPosts = $this->forumModel->getLatestPosts();

        switch ($_GET['sort'] ?? '') {
            case 'latest':
                $latestPosts = $this->forumModel->getLatestPosts();
                break;
            case 'most_viewed':
                $latestPosts = $this->forumModel->getMostViewedPosts();
                break;
            case 'most_engaged':
                $latestPosts = $this->forumModel->getMostEngagedPosts();
                break;
            default:
                break;
        }

        // Gửi dữ liệu qua view
        return $this->render('forum.index', [
            'mainCategories' => $mainCategories,
            'latestPosts' => $latestPosts
        ]);
    }

    //Hiển thị danh sách các subforum thuộc danh mục chính.
    public function category($mainCategorySlug)
    {
        // Gọi model để lấy danh mục chính
        $mainCategory = $this->forumModel->getCategoryBySlug($mainCategorySlug);

        if (!$mainCategory) {
            return $this->render('errors.404', ['error' => "Danh mục không tồn tại."]);
        }

        // Lấy danh sách các subforum thuộc danh mục chính
        $subforums = $this->forumModel->getSubforumsByMainCategorySlug($mainCategorySlug);

        foreach ($subforums as $subforum) {
            $subforum->posts_count = $this->forumModel->getPostCount($subforum->id);
            $subforum->comments_count = $this->forumModel->getCommentCount($subforum->id);
            $subforum->latest_post = $this->forumModel->getLatestPost($subforum->id);
        }

        // Gửi dữ liệu qua view
        $this->render('forum.category', [
            'mainCategory' => $mainCategory,
            'subforums' => $subforums,
        ]);
    }

    //Hiển thị thông tin chi tiết của subforum.
    public function subforum($mainCategorySlug, $subforumSlug)
    {
        // Gọi model để lấy subforum
        $subforum = $this->forumModel->getSubforumBySlug($subforumSlug);

        $mainCategory = $this->forumModel->getCategoryBySlug($mainCategorySlug);

        $posts = $this->forumModel->getTopicsBySubforumId($subforum->id);

        foreach ($posts as $post) {
            $post->comments_count = $this->forumModel->getCommentCountByTopicId($post->post_id);
            $post->latest_comment = $this->forumModel->getLatestCommentByTopicId($post->post_id);
            $post->views_count = $this->forumModel->getViewsCountByTopicId($post->post_id);
        }

        if (!$mainCategory) {
            return $this->render('errors.404', ['error' => "Danh mục không tồn tại."]);
        }

        if (!$subforum) {
            return $this->render('errors.404', ['error' => "Subforum không tồn tại."]);
        }

        // Gửi dữ liệu qua view
        $this->render('forum.subforum', ['subforum' => $subforum, 'mainCategory' => $mainCategory, 'posts' => $posts]);
    }
}
