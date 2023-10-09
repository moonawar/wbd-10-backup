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
                    <option value="All">All Authors and Genres</option>
                    <optgroup label="Author">
                    <?php foreach ($this->data['authors'] as $index => $author) : ?>
                                <option value="<?= $author['full_name'] ?>" <?php if (isset($_GET['filter']) && $_GET['filter'] == $author['full_name']) : ?> selected="selected" <?php endif; ?>>
                                    <?= $author['full_name'] ?>
                                </option>
                            <?php endforeach; ?>
                    </optgroup>
                    <optgroup label="Genres">
                    <?php foreach ($this->data['genres'] as $index => $genre) : ?>
                                <option value="<?= $genre['name'] ?>" <?php if (isset($_GET['filter']) && $_GET['filter'] == $genre['name']) : ?> selected="selected" <?php endif; ?>>
                                    <?= $genre['name'] ?>
                                </option>
                            <?php endforeach; ?>
                    </optgroup>
                </select>
                <select title="sort" id="year-book">
                    <option value="select">Sort</option>
                    <optgroup label="Year">
                        <option value="year-asc"<?php if (isset($_GET['sort']) && $_GET['sort'] == 'year asc') : ?> selected="selected"<?php endif; ?>>Year ASC</option>
                        <option value="year-dsc" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'year desc') : ?>selected="selected"<?php endif; ?>>Year DSC</option>
                    </optgroup>
                    <optgroup label="Book Name">
                        <option value="book-asc" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'book asc') : ?> selected="selected"<?php endif; ?>>Book ASC</option>
                        <option value="book-dsc" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'book dsc') : ?>selected="selected"<?php endif; ?>>Book DSC</option>
                    </optgroup>
                </select>
                <input type="text" name="q" class="search" placeholder="Search"/>
                <button type="submit" class="button green-button top-button">

                    <img src="<?= BASE_URL ?>/icon/search.svg" alt="Search Icon">
                </button>
            </form>
            <?php if (isset($this->data['username'])) : ?>
            <button type="submit" class="button green-button profile-button top-button">
                <img src="<?= BASE_URL ?>/<?= str_replace('/var/www/html/config/', '', $this->data['profpic']) ?>" style="width:2vw;height:2vw;border-radius:20px;"
                    alt="profile">
                    <?= $this->data['username'] ?>
            </button>
            <?php endif; ?>
        </div>
        <div class="booklist-container">
            <!-- Book List -->
            <?php if (!$this->data['book']) : ?>
                    <p class="info">There are no Books yet available on Audibook!</p>
            <?php else: ?>
            <?php foreach ($this->data['book'] as $book): ?>
                <div class="book-container">
                    <img class="book-image" src="<?= BASE_URL ?>/<?= str_replace('/var/www/html/config/', '', $book['cover_path']) ?>" alt="book-cover" />
                    <div class="info-text title-text"><?= $book['title'] ?></div>
                    <div class="info-text author-text">
                        <?= current(explode(',', $book['authors'])) ?>
                        <?php if (count(explode(',', $book['authors'])) > 1): ?>
                            , dkk
                        <?php endif; ?>
                    </div>
                    <div class="button-container">
                    <?php if (isset($this->data['username']) && $this->data['role']=='customer'):?>
                    <a type="button" class="button green-reverse-button" >Buy</a>
                    <?php elseif (isset($this->data['username']) && $this->data['role']=='admin'):?>
                    <a type="button" class="button green-reverse-button" >Edit</a>
                    <a type="button" class="button red-reverse-button" >Delete</a>
                    <?php endif;?>
                    <a type="button" class="button yellow-reverse-button" href="/book/details/<?=$book['book_id']?>">Details</a>
                </div>
                </div>
            <?php endforeach; ?>
            <?php endif; ?>

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