<?php

namespace App\Controllers;

use App\Models\Post;
use App\Models\AuthAccount;
use App\Controllers\BaseController;

class PostController extends BaseController
{
    public $post;
    public $authAccount;

    public function __construct()
    {
        $this->post = new Post();
        $this->authAccount = new AuthAccount();
    }

    public function addNewPost()
    {
        $this->post->addNewPost();
        $posts = $this->post->newsfeed();
        header('Location: /');
        return $this->render('home.index', compact('posts'));
    }

    public function incrementView($postId)
    {
        $success = $this->post->incrementViewCount($postId);

        if ($success) {
            echo json_encode(["status" => "success", "message" => "View count incremented."]);
        } else {
            echo json_encode(["status" => "error", "message" => "Failed to increment view count."]);
        }
    }

    public function postDetail($username, $postId)
    {
        // if username not found, redirect to 404
        $user = $this->authAccount->getByUsername($username);
        if (!$user) {
            return $this->render('errors.404');
        }
        $post = $this->post->getPostDetail($postId);
        $cmt = $this->post->getComments($postId);

        function organizeComments($comments, $maxDepth = 2)
        {
            // Step 1: Create a lookup array for direct access by comment ID
            $commentsById = [];
            foreach ($comments as $comment) {
                $comment->replies = [];
                $comment->depth = 0; // Initialize depth for each comment
                $commentsById[$comment->comment_id] = $comment;
            }

            // Step 2: Create a new array for top-level comments
            $nestedComments = [];
            foreach ($comments as $comment) {
                if ($comment->replying_to) {
                    // If it's a reply, find the parent comment
                    if (isset($commentsById[$comment->replying_to])) {
                        $parentComment = $commentsById[$comment->replying_to];

                        // If the parent comment's depth is less than maxDepth, add as a reply
                        if ($parentComment->depth < $maxDepth) {
                            $comment->depth = $parentComment->depth + 1; // Increment depth for child
                            $parentComment->replies[] = $comment; // Add to the parent's replies
                        } else {
                            // If depth exceeds maxDepth, add to the replies of the deepest allowed level (level 2)
                            $comment->depth = $maxDepth; // Set it to max depth
                            // Add the comment to the replies of the last valid level (level 2 replies)
                            $deepestValidReplies = $nestedComments;
                            while (!empty($deepestValidReplies) && isset($deepestValidReplies[0]->replies)) {
                                $deepestValidReplies = $deepestValidReplies[0]->replies;
                            }
                            $deepestValidReplies[] = $comment; // Add to deepest replies
                        }
                    }
                } else {
                    // If it's a top-level comment, add it to the top-level array
                    $nestedComments[] = $comment;
                }
            }

            return $nestedComments;
        }

        // Sample data
        $comments = organizeComments($cmt);

        // Output to verify structure
        // echo '<pre>';
        // print_r($organizedComments);
        // echo '</pre>';
        // die();
        return $this->render('post.index', compact('post', 'comments'));
    }

    public function addNewComment($username, $postId)
    {
        $this->post->addNewComment($postId);
        header("Location: /$username/posts/$postId");
    }
}
