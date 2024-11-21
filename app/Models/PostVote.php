<?php

namespace App\Models;

class PostVote extends BaseModel
{
    // Get a vote by post ID and user ID
    public function getVote($postId, $userId)
    {
        $this->setQuery("SELECT * FROM cyo_topic_votes WHERE topic_id = ? AND user_id = ?");
        $result = $this->loadRow([$postId, $userId]);
        return $result;
    }

    // Add or update a vote
    public function saveVote($postId, $userId, $voteType)
    {
        $existingVote = $this->getVote($postId, $userId);

        if ($existingVote) {
            // Update existing vote
            $this->setQuery("UPDATE cyo_topic_votes SET vote_value = ? WHERE topic_id = ? AND user_id = ?");
            return $this->execute([$voteType == "upvote" ? 1 : -1, $postId, $userId]);
        } else {
            // Insert new vote
            $this->setQuery("INSERT INTO cyo_topic_votes (topic_id, user_id, vote_value) VALUES (?, ?, ?)");
            return $this->execute([$postId, $userId, $voteType == "upvote" ? 1 : -1]);
        }
    }

    // Remove a vote
    public function removeVote($postId, $userId)
    {
        $this->setQuery("DELETE FROM cyo_topic_votes WHERE topic_id = ? AND user_id = ?");
        return $this->execute([$postId, $userId]);
    }

    // Count votes for a specific post
    public function countVotes($postId)
    {
        $this->setQuery("SELECT SUM(vote_value) AS votes FROM cyo_topic_votes WHERE topic_id = ?");
        return $this->loadRow([$postId]); // Return the sum of vote values
    }
}
