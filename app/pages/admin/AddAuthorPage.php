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
    <!-- Page-specific CSS -->
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/admin/crud-page.css">
    <title>Add Author</title>
</head>

<body>
    <!-- Navigation bar -->
    <?php include(dirname(__DIR__) . '../../components/Navbar.php') ?>
    <div class="content">
        <h2>Add Author Page</h2>
        <form class="form-box center-contents">
            <div class="form-content flex-column"> <label class="form-label" for="author-name">Author Name:</label>
                <input class="form-field" type="text" id="author-name" name="author-name" required>

                <label class="form-label" for="author-age">Author Age:</label>
                <input class="form-field" type="text" id="author-age" name="author-age" required>

                <input type="submit" class="button green-button" value="Add">
            </div>
        </form>
    </div>
</body>

</html>