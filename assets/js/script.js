function openModal() {
  var modal = $("#myModal");
  var btn = $("#openModalBtn");
  var closeBtn = $(".close");

  // When the user clicks the button, open the modal
  btn.click(function () {
    if (!isLoggedIn) {
      window.location.href = "/login";
    } else {
      modal.css("display", "block");
    }
  });

  // When the user clicks on the close button, close the modal
  closeBtn.click(function () {
    modal.css("display", "none");
  });

  // When the user clicks outside the modal, close it
  $(window).click(function (event) {
    if (event.target == modal[0]) {
      modal.css("display", "none");
    }
  });
}

// Enable/disable the create button based on input values
function toggleCreateButton() {
  var title = $("#postTitle").val().trim();
  var description = $("#postDescription").val().trim();
  var createButton = $("#createPostButton");

  if (title && description) {
    createButton.prop("disabled", false);
  } else {
    createButton.prop("disabled", true);
  }
}

// When the DOM is ready
$(document).ready(function () {
  openModal();

  // Attach input event listeners to title and description fields
  $("#postTitle, #postDescription").on("input", toggleCreateButton);
});

// Select all elements you want to adjust
const postContainers = document.querySelectorAll(".post-container"); // Replace with your actual selector

function adjustMaxWidth() {
  // Get the current window width
  const windowWidth = window.innerWidth;

  // Loop through each selected element and apply max-width based on the window width
  postContainers.forEach((postContainer) => {
    if (windowWidth < 768) {
      postContainer.style.maxWidth = `${windowWidth - 45}px`;
    } else {
      postContainer.style.maxWidth = "679px";
    }
  });
}

// Initial check when the page loads
adjustMaxWidth();

// Listen for the resize event
window.addEventListener("resize", adjustMaxWidth);

// Select all upvote and downvote buttons
const upvoteButtons = document.querySelectorAll(".upvote-button"); // Replace with your selector
const downvoteButtons = document.querySelectorAll(".downvote-button"); // Replace with your selector

// Function to handle voting
async function handleVote(postId, voteType, currentUserVote) {
  // Update UI immediately
  //   if (voteType === "upvote") {
  //     updateVoteUI(postId, 1, "upvote");
  //   } else if (voteType === "downvote") {
  //     updateVoteUI(postId, -1, "downvote");
  //   }
  try {
    // If the user is clicking the same button they previously clicked, cancel the vote
    if (currentUserVote === voteType) {
      voteType = "none"; // Remove vote (un-vote)
    }

    // Call the API to update the vote count
    const response = await fetch(
      `/api/vote?post_id=${postId}&vote_type=${voteType}`
    );

    const result = await response.json();

    if (response.status === 401) {
      window.location.href = "/login";
    }

    if (response.ok) {
      // Update UI based on response
      updateVoteUI(postId, result.newVoteCount, result.userVote);
    } else {
      console.error(result.message);
    }
  } catch (error) {
    console.error("Error voting:", error);
  }
}

// Function to update the UI
function updateVoteUI(postId, newVoteCount, userVote) {
  // Find the elements for the specific post
  const postElement = document.querySelector(`[data-post-id="${postId}"]`);
  const voteCountElement = postElement.querySelector(".vote-count");
  const upvoteButton = postElement.querySelector(".upvote-button");
  const downvoteButton = postElement.querySelector(".downvote-button");

  // Update the vote count display
  voteCountElement.textContent = newVoteCount;

  // Update the button styles based on the user's vote
  if (userVote === "upvote") {
    upvoteButton.classList.add("text-green-500");
    downvoteButton.classList.remove("text-red-500");
    voteCountElement.classList.add("text-green-500");
    voteCountElement.classList.remove("text-red-500");
  } else if (userVote === "downvote") {
    downvoteButton.classList.add("text-red-500");
    upvoteButton.classList.remove("text-green-500");
    voteCountElement.classList.add("text-red-500");
    voteCountElement.classList.remove("text-green-500");
  } else {
    // Clear styles if no vote
    upvoteButton.classList.remove("text-green-500");
    downvoteButton.classList.remove("text-red-500");
    voteCountElement.classList.remove("text-green-500");
    voteCountElement.classList.remove("text-red-500");
  }
}

// Add event listeners to upvote and downvote buttons
upvoteButtons.forEach((button) => {
  button.addEventListener("click", () => {
    const postId = button.closest("[data-post-id]").dataset.postId;
    const currentUserVote = button.classList.contains("text-green-500")
      ? "upvote"
      : "none";
    handleVote(postId, "upvote", currentUserVote);
  });
});

downvoteButtons.forEach((button) => {
  button.addEventListener("click", () => {
    const postId = button.closest("[data-post-id]").dataset.postId;
    const currentUserVote = button.classList.contains("text-red-500")
      ? "downvote"
      : "none";
    handleVote(postId, "downvote", currentUserVote);
  });
});

document.querySelectorAll(".save-post-button").forEach((button) => {
  button.addEventListener("click", async () => {
    if (!isLoggedIn) {
      window.location.href = "/login";
    }

    const postId = button.closest("[data-post-id]").dataset.postId;

    try {
      const response = await fetch(`/api/posts/${postId}/toggle-save`);

      const result = await response.json();
      if (result.status === "saved") {
        button.classList.add("bg-[#CDEBCA]");
        button.querySelector("ion-icon").classList.add("text-green-500");
        button.classList.remove("bg-[#EAEAEA]");
        button.querySelector("ion-icon").classList.remove("text-gray-400");
      } else {
        button.classList.remove("bg-[#CDEBCA]");
        button.querySelector("ion-icon").classList.remove("text-green-500");
        button.classList.add("bg-[#EAEAEA]");
        button.querySelector("ion-icon").classList.add("text-gray-400");
      }
    } catch (error) {
      console.error("Error toggling save status:", error);
    }
  });
});

document.addEventListener("DOMContentLoaded", function () {
  const posts = document.querySelectorAll(".post-container");

  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          const postId = entry.target.getAttribute("data-post-id");
          fetch(`/api/posts/${postId}/increment-view`)
            .then((response) => {
              if (!response.ok) {
                console.error("Failed to increment post view");
              }
            })
            .catch((error) => {
              console.error("Error:", error);
            });
          observer.unobserve(entry.target);
        }
      });
    },
    {
      threshold: 0.5,
    }
  );

  posts.forEach((post) => {
    observer.observe(post);
  });
});
