function openModal() {
  var modal = $("#myModal");
  var btn = $("#openModalBtn");
  var btn2 = $("#openModalBtn2");
  var closeBtn = $(".close");

  // When the user clicks the button, open the modal
  btn.click(function () {
    if (!isLoggedIn) {
      window.location.href = "/login";
    } else {
      modal.css("display", "block");
    }
  });

  btn2.click(function () {
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

  document.querySelectorAll(".followBtns").forEach((button) => {
    button.addEventListener("click", function (event) {
      if (!isLoggedIn) {
        window.location.href = "/login";
        return;
      }

      // Get the element that was clicked
      const clickedElement = event.target;

      // Get the data-follow-uid attribute from the clicked element
      const followUid = clickedElement.getAttribute("data-follow-uid");

      fetch(`/api/toggle-follow?followed_id=${followUid}`)
        .then((response) => response.json())
        .then((result) => {
          if (result.status === "followed") {
            // change the button class
            clickedElement.classList.remove("btn-outline-success");
            clickedElement.classList.remove("hover:bg-green-600");
            clickedElement.classList.remove("text-green-600");
            clickedElement.classList.add("btn-success");
            clickedElement.classList.add("bg-green-600");
            // change the button text
            clickedElement.textContent = "Đang theo dõi";
          } else {
            // change the button class
            clickedElement.classList.remove("btn-success");
            clickedElement.classList.remove("bg-green-600");
            clickedElement.classList.add("btn-outline-success");
            clickedElement.classList.add("hover:bg-green-600");
            clickedElement.classList.add("text-green-600");
            clickedElement.textContent = "Theo dõi";
          }
        });
    });
  });
});

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
  const voteCountElements = postElement.querySelectorAll(".vote-count");
  const upvoteButtons = postElement.querySelectorAll(".upvote-button");
  const downvoteButtons = postElement.querySelectorAll(".downvote-button");

  // Iterate over each vote count element and update the display
  voteCountElements.forEach((voteCountElement) => {
    voteCountElement.textContent = newVoteCount;
  });

  // Iterate over each upvote button and update the styles
  upvoteButtons.forEach((upvoteButton) => {
    if (userVote === "upvote") {
      upvoteButton.classList.add("text-green-500");
    } else {
      upvoteButton.classList.remove("text-green-500");
    }
  });

  // Iterate over each downvote button and update the styles
  downvoteButtons.forEach((downvoteButton) => {
    if (userVote === "downvote") {
      downvoteButton.classList.add("text-red-500");
    } else {
      downvoteButton.classList.remove("text-red-500");
    }
  });

  // Update the vote count element styles based on the user's vote
  voteCountElements.forEach((voteCountElement) => {
    if (userVote === "upvote") {
      voteCountElement.classList.add("text-green-500");
      voteCountElement.classList.remove("text-red-500");
    } else if (userVote === "downvote") {
      voteCountElement.classList.add("text-red-500");
      voteCountElement.classList.remove("text-green-500");
    } else {
      voteCountElement.classList.remove("text-green-500");
      voteCountElement.classList.remove("text-red-500");
    }
  });
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

function handleUploadAvatar() {
  // Lấy các phần tử
  const fileInput2 = document.getElementById("fileInput2");

  fileInput2.click();

  // Thêm sự kiện để xử lý khi người dùng chọn tệp
  fileInput2.addEventListener("change", function (e) {
    console.log("File selected:", e.target.files[0]);
    const file = e.target.files[0];
    if (file) {
      // Generate image preview
      const reader = new FileReader();
      reader.onloadend = () => {
        document.getElementById("previewAvatar").src = reader.result;
      }; // Set preview URL to file reader result
      reader.readAsDataURL(file); // Read file as a data URL
    }
  });
}

// Function to get the selected value or ID from uk-select
function getSelectedIdFromUkSelect() {
  // Select the placeholder button showing the current selection
  const selectedElement = document.querySelector(
    "#subforumId .uk-input-fake span"
  );

  if (selectedElement) {
    const selectedText = selectedElement.textContent.trim(); // Get the visible text
    console.log("Selected Text:", selectedText);

    // Map the text to an ID if needed (you can maintain a mapping in a separate object)

    const selectedId = subforum[selectedText] || null; // Get ID from mapping
    console.log("Selected ID:", selectedId);

    return selectedId;
  } else {
    console.error("No selection found");
    return null;
  }
}

document
  .getElementById("createPostForm")
  .addEventListener("submit", async function (event) {
    event.preventDefault(); // Prevent the form from submitting normally

    const title = document.getElementById("postTitle").value;
    const content = document.getElementById("postDescription").value;
    const subforumId = getSelectedIdFromUkSelect(); // Get the selected subforum ID
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
      await createPost(title, content, imageId, subforumId);
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

async function createPost(title, content, imageId, subforumId) {
  const formData = new FormData();
  formData.append("title", title);
  formData.append("content", content);
  if (subforumId) formData.append("subforumId", subforumId);
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
var isProcessing = false;

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

function togglePassword(inputId, button) {
  const input = document.getElementById(inputId);
  const icon = button.querySelector("ion-icon");

  if (input.type === "password") {
    input.type = "text";
    icon.setAttribute("name", "eye-off-outline");
  } else {
    input.type = "password";
    icon.setAttribute("name", "eye-outline");
  }
}

function handleFollowClick(uid, isFollow) {
  if (isProcessing) return;
  isProcessing = true;

  if (isFollow) {
    follow(uid);
  } else {
    unfollow(uid);
  }
}

function toggleFollow(userId) {
  if (!isLoggedIn) {
    window.location.href = "/login";
    return;
  }

  fetch(`/api/toggle-follow?followed_id=${userId}`)
    .then((response) => response.json())
    .then((result) => {
      const followButtons = document.getElementsByClassName("followBtn");
      const followerCounts = document.getElementsByClassName("follower_count");

      Array.from(followButtons).forEach((button) => {
        if (result.status === "followed") {
          // change the button class
          button.classList.remove("btn-outline-success");
          button.classList.remove("hover:bg-green-600");
          button.classList.remove("text-green-600");
          button.classList.add("btn-success");
          button.classList.add("bg-green-600");
          // change the button text
          button.textContent = "Đang theo dõi";
        } else {
          // change the button class
          button.classList.remove("btn-success");
          button.classList.remove("bg-green-600");
          button.classList.add("btn-outline-success");
          button.classList.add("hover:bg-green-600");
          button.classList.add("text-green-600");
          // change the button text
          button.textContent = "Theo dõi";
        }
      });

      Array.from(followerCounts).forEach((countElement) => {
        if (result.status === "followed") {
          countElement.textContent = parseInt(countElement.textContent) + 1;
        } else {
          countElement.textContent = parseInt(countElement.textContent) - 1;
        }
      });
    })
    .catch((error) => {
      console.error("Error following user:", error);
    });
  isProcessing = false;
}

function adjustColspan() {
  const tds = document.getElementsByClassName("responsive-td");
  const smBreakpoint = 640; // Tailwind's sm breakpoint in pixels
  for (let td of tds) {
    if (window.innerWidth < smBreakpoint) {
      td.setAttribute("colspan", "2");
    } else {
      td.removeAttribute("colspan");
    }
  }
}

// Run on page load
adjustColspan();

// Add event listener for screen resizing
window.addEventListener("resize", adjustColspan);
