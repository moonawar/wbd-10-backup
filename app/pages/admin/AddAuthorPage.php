<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" sizes="180x180" href="<?= BASE_URL ?>/icon/favicon-110.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= BASE_URL ?>/icon/favicon-32.png">
    <!-- Global CSS -->
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/template/globals.css">
    <!-- Navbar CSS -->
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/template/navbar.css">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/template/popup.css">
    <!-- Page-specific CSS -->
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/admin/crud-page.css">
    <title>Add Author</title>
</head>

<body>
    <!-- Navigation bar -->
    <?php include(dirname(__DIR__) . '../../components/Navbar.php') ?>
    <section>
        <!-- Pop Up -->
        <span class="overlay"></span>

        <div class="modal-box">
            <h2>Add Author</h2>
            <h3>Are you sure want to add this Author?</h3>

            <div class="buttons">
                <button class="cancel-btn">Cancel</button>
                <button id="addAuthorBtn" class="confirm-btn">Add</button>
            </div>
        </div>
        <div class="content">
            <h2>Add Author Page</h2>
            <form 
                id="addAuthorForm"
                class="form-box center-contents"
            >
                <div class="form-content flex-column"> <label class="form-label" for="author-name">Author Name:</label>
                    <input class="form-field" type="text" id="author-name" name="author-name" required>

                    <label class="form-label" for="author-age">Author Age:</label>
                    <input class="form-field" type="number" id="author-age" name="author-age" required>

                    <input type="button" class="show-modal button green-button" value="Add">
                </div>
            </form>
        </div>
    </section>
</body>
<script>
    const section = document.querySelector("section"),
        overlay = document.querySelector(".overlay"),
        showBtn = document.querySelector(".show-modal"),
        closeBtn = document.querySelector(".cancel-btn"),
        editUser = document.getElementById("addAuthorBtn");

        editUser.addEventListener("click", function (event) {
            event.preventDefault();
            const form = document.getElementById("addAuthorForm");
            form.action="/author/add/"
            form.method = "POST";
            form.enctype = "multipart/form-data";
            form.submit();
        });

    showBtn.addEventListener("click", ()=>section.classList.add("active"));

    overlay.addEventListener("click", () =>
        section.classList.remove("active")
    );

    closeBtn.addEventListener("click", () =>
        section.classList.remove("active")
    );
</script>

</html>