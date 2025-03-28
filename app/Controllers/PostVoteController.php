<?php
// app/Controllers/PostVoteController.php
namespace App\Controllers;

use App\Models\PostVote;

class PostVoteController extends BaseController
{
    private $postVoteModel;

    public function __construct()
    {
        $this->postVoteModel = new PostVote();
    }

    // Handle voting action (upvote, downvote, or cancel vote)
    public function handleVote()
    {
        if (!isset($_SESSION['user'])) {
            http_response_code(401);
            echo json_encode(['message' => 'You must be logged in to vote']);
            return;
        }

        $postId = $_GET['post_id'] ?? 0;
        $userId = $_GET['user_id'] ?? $_SESSION['user']->id ?? 0;
        $voteType = $_GET['vote_type'] ?? "";
        // Validate vote type
        if (!in_array($voteType, ['upvote', 'downvote', 'none'])) {
            echo json_encode(['message' => 'Invalid vote type']);
            return;
        }



        // Check if user has already voted on this post
        $existingVote = $this->postVoteModel->getVote($postId, $userId);

        if ($existingVote) {
            // If user is canceling their vote (i.e., clicking on already selected vote)
            if ($voteType == 'none') {
                $this->postVoteModel->removeVote($postId, $userId);
                // Get the new vote counts for upvotes and downvotes
                $current_votes = $this->postVoteModel->countVotes($postId)->votes;
                echo json_encode(['message' => 'Vote removed', 'newVoteCount' => $current_votes ?? 0]);
                return;
            }

            // Otherwise, update the vote
            $this->postVoteModel->saveVote($postId, $userId, $voteType);
        } else {
            // Add new vote if no existing vote found
            $this->postVoteModel->saveVote($postId, $userId, $voteType);
        }

        // Get the new vote counts for upvotes and downvotes
        $current_votes = $this->postVoteModel->countVotes($postId)->votes;

        echo json_encode([
            'message' => 'Vote registered successfully',
            'newVoteCount' => $current_votes,
            'userVote' => $voteType,
        ]);
    }
}
