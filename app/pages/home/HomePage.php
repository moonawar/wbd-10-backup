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
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/home/home.css">
    <title>Home</title>
</head>

<body>
    <!-- Navigation bar -->
    <?php include(dirname(__DIR__) . '../../components/Navbar.php') ?>
    <div class="home-container">
        <div class="topbar-container">
            <form action="#" class="selection">
                <select title="filter" id="author-genre">
                    <option value="select">All Authors and Genres</option>
                    <optgroup label="Author">
                        <option value="rick riordan">Rick Riordan</option>
                        <option value="J.K Rowling">J.K Rowling</option>
                    </optgroup>
                    <optgroup label="Genres">
                        <option value="fantasy">Fantasy</option>
                        <option value="comedy">Comedy</option>
                    </optgroup>
                </select>
                <select title="sort" id="year-book">
                    <option value="select">Sort</option>
                    <optgroup label="Year">
                        <option value="year-asc">Year ASC</option>
                        <option value="year-dsc">Year DSC</option>
                    </optgroup>
                    <optgroup label="Book Name">
                        <option value="book-asc">Book ASC</option>
                        <option value="book-dsc">Book DSC</option>
                    </optgroup>
                </select>
                <input type="text" class="search" placeholder="Search" />
                <button type="submit" class="button green-button top-button">
                    <img src="<?= BASE_URL ?>/icon/search.svg" alt="Search Icon">
                </button>
            </form>
            <button type="submit" class="button green-button profile-button top-button">
                <img src="<?= BASE_URL ?>/../storage/profile-base.jpg" style="width:2vw;height:2vw;border-radius:20px;"
                    alt="profile">
                Username
            </button>
        </div>
        <div class="booklist-container">
            <!-- Book List -->
            <!-- todo for each -->
            <div class="book-container">
                <img class="book-image" src="<?= BASE_URL ?>/../storage/cover/cerita-sang-pembelajar.png"
                    alt="book-cover" />
                <div class="info-text title-text">Cerita Sang Pembelajar</div>
                <div class="info-text author-text">author name</div>
                <div class="button-container">
                    <button type="button" class="button green-reverse-button">Buy</button>
                    <button type="button" class="button yellow-reverse-button">Details</button>
                </div>
            </div>
            <div class="book-container">
                <img class="book-image" src="<?= BASE_URL ?>/../storage/cover/cerita-sang-pembelajar.png"
                    alt="book-cover" />
                <div class="info-text title-text">Cerita Sang Pembelajar</div>
                <div class="info-text author-text">author name</div>
                <div class="button-container">
                    <button type="button" class="button green-reverse-button">Buy</button>
                    <button type="button" class="button yellow-reverse-button">Details</button>
                </div>
            </div>
            <div class="book-container">
                <img class="book-image" src="<?= BASE_URL ?>/../storage/cover/cerita-sang-pembelajar.png"
                    alt="book-cover" />
                <div class="info-text title-text">Cerita Sang Pembelajar</div>
                <div class="info-text author-text">author name</div>
                <div class="button-container">
                    <button type="button" class="button green-reverse-button">Buy</button>
                    <button type="button" class="button yellow-reverse-button">Details</button>
                </div>
            </div>
            <div class="book-container">
                <img class="book-image" src="<?= BASE_URL ?>/../storage/cover/cerita-sang-pembelajar.png"
                    alt="book-cover" />
                <div class="info-text title-text">Cerita Sang Pembelajar</div>
                <div class="info-text author-text">author name</div>
                <div class="button-container">
                    <button type="button" class="button green-reverse-button">Buy</button>
                    <button type="button" class="button yellow-reverse-button">Details</button>
                </div>
            </div>
            <div class="book-container">
                <img class="book-image" src="<?= BASE_URL ?>/../storage/cover/cerita-sang-pembelajar.png"
                    alt="book-cover" />
                <div class="info-text title-text">Cerita Sang Pembelajar</div>
                <div class="info-text author-text">author name</div>
                <div class="button-container">
                    <button type="button" class="button green-reverse-button">Buy</button>
                    <button type="button" class="button yellow-reverse-button">Details</button>
                </div>
            </div>
            <div class="book-container">
                <img class="book-image" src="<?= BASE_URL ?>/../storage/cover/dillan.png" alt="book-cover" />
                <div class="info-text title-text">Dillan</div>
                <div class="info-text author-text">author name</div>
                <div class="button-container">
                    <button type="button" class="button green-reverse-button">Buy</button>
                    <button type="button" class="button yellow-reverse-button">Details</button>
                </div>
            </div>
        </div>
        <div class="pagination">
            <button class="arrow-wrapper" type="button">
                <img class="page-arrow" src="<?= BASE_URL ?>/icon/left-arrow.svg" alt="left-arrow" />
            </button>
            <div class="green-reverse-button inner-box">
                1
            </div>
            <div class="green-reverse-button inner-box">
                2
            </div>
            <button class="arrow-wrapper" type="button">
                <img class="page-arrow" src="<?= BASE_URL ?>/icon/right-arrow.svg" alt="left-arrow" />
</button>
        </div>
    </div>
</body>

</html>