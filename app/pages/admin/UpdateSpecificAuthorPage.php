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
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/admin/list.css">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/admin/crud-page.css">
    <title>Update Author : <? echo $this->data['author_id'];?></title>
</head>

<body>
    <!-- Navigation bar -->
    <?php include(dirname(__DIR__) . '../../components/Navbar.php') ?>
    <section>
        <!-- Pop Up -->
        <span class="overlay"></span>

        <div class="modal-box">
            <h2>Edit Author</h2>
            <h3>Are you sure want to edit this Author?</h3>

            <div class="buttons">
                <button class="cancel-btn">Cancel</button>
                <button id="editAuthorBtn" class="confirm-btn">Edit</button>
            </div>
        </div>
        <div class="wrapper-small">
            <div class="pad-40">
                    <h1>Update Author Page</h1>
                    <form  
                        id="editAuthorForm"
                        action="/author/update/<? echo $this->data['author_id']?>" method="POST" enctype="multipart/form-data"
                    >
                        <p class="form-label">Author ID : <?
                            echo $this->data['author_id'];
                        ?></p>
                        <p class="form-label">Previous Name : <?
                            echo $this->data['full_name'];
                        ?></p>
                        <p class="form-label">Previous Age : <?
                            echo $this->data['age'];
                        ?></p>
                        
                        <br>
                        <label class="form-label" for="full_name">New Author Name:</label><br>
                        <input class="form-field" type="text" id="full_name" name="full_name" required>

                        <br><br>

                        <label class="form-label" for="age">New Author Age:</label><br>
                        <input class="form-field" type="number" id="age" name="age" required>

                        <br><br>
                        
                        <input type="button" class="show-modal button green-button" value="Update">

                    </form>
            </div>
        </div>
    </section>
</body>
<script>
    const section = document.querySelector("section"),
        overlay = document.querySelector(".overlay"),
        showBtn = document.querySelector(".show-modal"),
        closeBtn = document.querySelector(".cancel-btn"),
        editAuthor = document.getElementById("editAuthorBtn");

        editAuthor.addEventListener("click", function (event) {
            event.preventDefault();
            const form = document.getElementById("editAuthorForm");
            form.action="/author/update/<? echo $this->data['author_id']?>"
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