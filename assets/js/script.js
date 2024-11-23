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

var createButton = $("#createPostButton");
// Enable/disable the create button based on input values
function toggleCreateButton() {
  var title = $("#postTitle").val().trim();
  var description = $("#postDescription").val().trim();

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

// Lấy các phần tử
const customDiv = document.getElementById("selectImage");
const fileInput = document.getElementById("fileInput");

// Thêm sự kiện click vào div
customDiv.addEventListener("click", function () {
  // Kích hoạt sự kiện click của input file
  fileInput.click();
});

// Thêm sự kiện để xử lý khi người dùng chọn tệp
fileInput.addEventListener("change", function (e) {
  console.log("File selected:", e.target.files[0]);
  const file = e.target.files[0];
  if (file) {
    // Generate image preview
    const reader = new FileReader();
    reader.onloadend = () => {
      document.getElementById("imagePreview").src = reader.result;
      document.getElementById("imagePreview").classList.remove("hidden");
    }; // Set preview URL to file reader result
    reader.readAsDataURL(file); // Read file as a data URL
  }
});

document
  .getElementById("createPostForm")
  .addEventListener("submit", async function (event) {
    event.preventDefault(); // Prevent the form from submitting normally

    const title = document.getElementById("postTitle").value;
    const content = document.getElementById("postDescription").value;
    const imageFile = document.getElementById("fileInput").files[0];

    try {
      createButton.prop("disabled", true);
      createButton.text("Đang đăng bài viết...");

      // Step 1: Upload the image and get the image path
      // check if image file is selected
      if (imageFile) {
        var imageId = await uploadImage(imageFile);
      } else {
        imageId = null;
      }

      // Step 2: Create the post with the uploaded image's path
      await createPost(title, content, imageId);
    } catch (error) {
      console.log(error);
    }
  });

async function uploadImage(imageFile) {
  const formData = new FormData();
  formData.append("uid", uid);
  formData.append("file", imageFile);

  const response = await fetch("https://api.chuyenbienhoa.com/v1.0/upload", {
    method: "POST",
    body: formData,
  });

  if (!response.ok) {
    throw new Error("Image upload failed");
  }

  const data = await response.json();
  return data.id;
}

async function createPost(title, content, imageId) {
  const formData = new FormData();
  formData.append("title", title);
  formData.append("content", content);
  if (imageId) formData.append("imageId", imageId);

  const response = await fetch("/", {
    method: "POST",
    body: formData,
  });

  if (!response.ok) {
    throw new Error("Post creation failed");
  } else {
    // Reload the page to see the new post
    window.location.reload();
  }

  return true;
}

// Select all upvote and downvote buttons
const commentUpvoteButtons = document.querySelectorAll(
  ".comment-upvote-button"
); // Replace with your selector
const commentDownvoteButtons = document.querySelectorAll(
  ".comment-downvote-button"
); // Replace with your selector

// Function to handle voting
async function handleCommentVote(commentId, voteType, currentUserVote) {
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
      `/api/comment/vote?comment_id=${commentId}&vote_type=${voteType}`
    );

    const result = await response.json();

    if (response.status === 401) {
      window.location.href = "/login";
    }

    if (response.ok) {
      // Update UI based on response
      updateCommentVoteUI(commentId, result.newVoteCount, result.userVote);
    } else {
      console.error(result.message);
    }
  } catch (error) {
    console.error("Error voting:", error);
  }
}

// Function to update the UI
function updateCommentVoteUI(commentId, newVoteCount, userVote) {
  // Find the elements for the specific post
  const commentElement = document.querySelector(
    `[data-comment-id="${commentId}"]`
  );
  const voteCountElement = commentElement.querySelector(".vote-count");
  const upvoteButton = commentElement.querySelector(".comment-upvote-button");
  const downvoteButton = commentElement.querySelector(
    ".comment-downvote-button"
  );

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
commentUpvoteButtons.forEach((button) => {
  button.addEventListener("click", () => {
    const commentId = button.closest("[data-comment-id]").dataset.commentId;
    const currentUserVote = button.classList.contains("text-green-500")
      ? "upvote"
      : "none";
    handleCommentVote(commentId, "upvote", currentUserVote);
  });
});

commentDownvoteButtons.forEach((button) => {
  button.addEventListener("click", () => {
    const commentId = button.closest("[data-comment-id]").dataset.commentId;
    const currentUserVote = button.classList.contains("text-red-500")
      ? "downvote"
      : "none";
    handleCommentVote(commentId, "downvote", currentUserVote);
  });
});

document.querySelectorAll(".reply-comment").forEach((button) => {
  button.addEventListener("click", () => {
    if (!isLoggedIn) {
      window.location.href = "/login";
      return;
    }
    const replyBox = button
      .closest(".flex.space-x-4")
      .querySelector(".reply-box");
    replyBox.classList.toggle("hidden");
  });
});
