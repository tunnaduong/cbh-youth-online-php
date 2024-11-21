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
