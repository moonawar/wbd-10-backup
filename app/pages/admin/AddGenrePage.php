<!DOCTYPE html>
<html>

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
    <title>Add Genre</title>
</head>

<body>
    <!-- Navigation bar -->
    <?php include(dirname(__DIR__) . '../../components/Navbar.php') ?>
    <section>
        <!-- Pop Up -->
        <span class="overlay"></span>

        <div class="modal-box">
            <h2>Add Genre</h2>
            <h3>Are you sure want to add this genre?</h3>

            <div class="buttons">
                <button class="cancel-btn">Cancel</button>
                <button id="addGenreBtn" class="confirm-btn">Add</button>
            </div>
        </div>
        <div class="container">
            <div class="content">
                <h2>Add Genre Page</h2>
                <form 
                id="addGenreForm"
                class="form-box center-contents"
            >
                    <div class="form-content flex-column">
                        <label class="form-label" for="genre">Genre:</label>
                        <input class="form-field" type="text" id="genre" name="genre" required>
                        <input type="button" class="show-modal button green-button" value="Add">
                    </div>
                </form>
            </div>
        </div>
    </section>
    <script>
    const section = document.querySelector("section"),
        overlay = document.querySelector(".overlay"),
        showBtn = document.querySelector(".show-modal"),
        closeBtn = document.querySelector(".cancel-btn"),
        addGenreBtn = document.getElementById("addGenreBtn");

    function showModal() {
        const inputFields = document.querySelectorAll('.form-field');

        // Check if any input field is empty
        const isEmpty = Array.from(inputFields).some(field => field.value.trim() === '');

        if (!isEmpty) {
            section.classList.add("active");
        } else {
            alert("Please fill in all the required fields.");
            showBtn.removeEventListener("click", showModal);
        }
    }
    addGenreBtn.addEventListener("click", function () {
            const form = document.getElementById("addGenreForm");
            form.action = "/genre/add";
            form.method = "POST";
            form.enctype = "multipart/form-data";
            form.submit();
        });

    showBtn.addEventListener("click", showModal);

    overlay.addEventListener("click", () =>
        section.classList.remove("active")
    );

    closeBtn.addEventListener("click", () =>
        section.classList.remove("active")
    );
</script>
</body>

</html>