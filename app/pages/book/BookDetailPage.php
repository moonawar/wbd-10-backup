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
    <!-- Page-specific CSS -->
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/book/book-detail.css">
    <title>Home</title>
</head>
<body>
    <!-- Navigation bar -->
    <?php include(dirname(__DIR__) . '../../components/Navbar.php') ?>
    <div class="container">
        <h2>DETAILS</h2>
        <!-- Book Cover -->
        <img src="<?= BASE_URL ?>/../storage/image/book_cover/Astor.jpg"/>
        <div class="details-container">
        <!-- Book Title -->
        <h3> Title </h3>

        <!-- Author Genre Year-->
        <h4>Author</h4>
        <h4>Genre</h4>
        <h4>Year</h4>

        <!-- Decription -->
        <p> description</p>
        </div>
    </div>
</body>
</html>.