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
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/admin/list.css">
    <title>Update User : <? echo $this->data['username'];?></title>
</head>

<body>
    <!-- Navigation bar -->
    <?php include(dirname(__DIR__) . '../../components/Navbar.php') ?>
    <section>
        <!-- Pop Up -->
        <span class="overlay"></span>

        <div class="modal-box">
            <h2>Edit User</h2>
            <h3>Are you sure want to edit this User?</h3>

            <div class="buttons">
                <button class="cancel-btn">Cancel</button>
                <button id="editUserBtn" class="confirm-btn">Edit</button>
            </div>
        </div>
        <div class="wrapper-small">
            <div class="pad-40">
                <h1>Update User Page</h1>
                <div class="centered">
                    <form  
                        class="center-contents" id="editUserForm"
                        action="/user/update/<? echo $this->data['username']?>" method="POST" enctype="multipart/form-data"
                    >
                        <p class="form-label">Username : <?
                            echo $this->data['username'];
                        ?></p>

                        <label class="form-label" for="role">User Role:</label>
                        <select class="select" id="role" name="role" value="<? echo $this->data['role'];?>">
                            <option value="customer">Customer</option>
                            <option value="admin">Admin</option>
                        </select>

                        <input type="button" class="show-modal button green-button" value="Update">

                    </form>
                </div>
            </div>
        </div>
    </section>
</body>
<script>
    const section = document.querySelector("section"),
        overlay = document.querySelector(".overlay"),
        showBtn = document.querySelector(".show-modal"),
        closeBtn = document.querySelector(".cancel-btn"),
        editUser = document.getElementById("editUserBtn");

        editUser.addEventListener("click", function (event) {
            event.preventDefault();
            const form = document.getElementById("editUserForm");
            form.action="/user/update/<? echo $this->data['username']?>"
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