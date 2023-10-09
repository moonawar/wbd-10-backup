<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />

    <title>Popup Modal Box</title>

    <!-- CSS -->
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <section>
      <button class="show-modal">Show Modal</button>
      <span class="overlay"></span>

      <div class="modal-box">
        <h2>Delete Content</h2>
        <h3>Are you sure want to delete this content?</h3>

        <div class="buttons">
          <button class="cancel-btn">Cancel</button>
          <button class="confirm-btn">Delete</button>
        </div>
      </div>
    </section>

    <script>
      const section = document.querySelector("section"),
        overlay = document.querySelector(".overlay"),
        showBtn = document.querySelector(".show-modal"),
        closeBtn = document.querySelector(".cancel-btn");

      showBtn.addEventListener("click", () => section.classList.add("active"));

      overlay.addEventListener("click", () =>
        section.classList.remove("active")
      );

      closeBtn.addEventListener("click", () =>
        section.classList.remove("active")
      );
    </script>
  </body>
</html>
