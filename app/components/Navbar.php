<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" sizes="180x180" href="<?= BASE_URL ?>/images/icon/favicon-110.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= BASE_URL ?>/images/icon/favicon-32.png">
    <!-- Global CSS -->
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/template/globals.css">
    <!-- Page-specific CSS -->
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/template/navbar.css">
    <title>Navbar</title>
</head>

<body>
    <nav class="teal-bar">
        <input type="checkbox" id="check">
        <label for="check">
        <img src="<?= BASE_URL ?>/icon/close.svg" alt="Close menu" width="3%" id="btn">
            <img src="<?= BASE_URL ?>/icon/white-menu.png" alt="menu icon" width="4%" id="open">
        </label>
        <div class="sidebar">
            <div class="top">
            <img src="<?= BASE_URL ?>/images/white-logo.svg" alt="White Logo" width="80%">
            </div>  
            <ul>
                <li>
                    <a class="#" href="#">
                        <img src="<?= BASE_URL ?>/icon/dashboard.svg" alt="Dashboard Icon">
                        Dashboard
                    </a>
                </li>
                <li>
                    <a class="#" href="#">
                        <img src="<?= BASE_URL ?>/icon/home.svg" alt="Home Icon"> 
                        Book List
                    </a>
                </li>
                <li>
                    <a class="#" href="#">
                        <img src="<?= BASE_URL ?>/icon/genre.svg" alt="Genre Icon"> 
                        Genres
                    </a>
                </li>
                <li>
                    <a class="#" href="#">
                        <img src="<?= BASE_URL ?>/icon/author.svg" alt="Author Icon">
                        Author
                    </a>
                </li>
            </ul>
            <button class="section">
                    <div class="title">Log Out</div>
            </button>
        </div>
    </nav>
</body>
</html>