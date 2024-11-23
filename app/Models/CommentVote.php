<?php

namespace App\Models;

class CommentVote extends BaseModel
{
    // Get a vote by post ID and user ID
    public function getVote($commentId, $userId)
    {
        $this->setQuery("SELECT * FROM cyo_topic_comment_votes WHERE comment_id = ? AND user_id = ?");
        $result = $this->loadRow([$commentId, $userId]);
        return $result;
    }

    // Add or update a vote
    public function saveVote($commentId, $userId, $voteType)
    {
        $existingVote = $this->getVote($commentId, $userId);

        if ($existingVote) {
            // Update existing vote
            $this->setQuery("UPDATE cyo_topic_comment_votes SET vote_value = ? WHERE comment_id = ? AND user_id = ?");
            return $this->execute([$voteType == "upvote" ? 1 : -1, $commentId, $userId]);
        } else {
            // Insert new vote
            $this->setQuery("INSERT INTO cyo_topic_comment_votes (comment_id, user_id, vote_value, created_at, updated_at) VALUES (?, ?, ?, ?, ?)");
            return $this->execute([$commentId, $userId, $voteType == "upvote" ? 1 : -1, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        }
    }

    // Remove a vote
    public function removeVote($commentId, $userId)
    {
        $this->setQuery("DELETE FROM cyo_topic_comment_votes WHERE comment_id = ? AND user_id = ?");
        return $this->execute([$commentId, $userId]);
    }

    // Count votes for a specific post
    public function countVotes($commentId)
    {
        $this->setQuery("SELECT SUM(vote_value) AS votes FROM cyo_topic_comment_votes WHERE comment_id = ?");
        return $this->loadRow([$commentId]); // Return the sum of vote values
    }
}
