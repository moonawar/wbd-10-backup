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
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/admin/list.css">
    <title>Delete Book : <? echo $this->data['title'];?></title>
</head>

<body>
    <!-- Navigation bar -->
    <?php include(dirname(__DIR__) . '../../components/Navbar.php') ?>
    <div class="wrapper-small">
        <div class="pad-40">
            <h1>Delete Book Page</h1>
            <div class="centered">
                <form  
                    class="center-contents"
                    action="/book/delete/<? echo $this->data['book_id']?>" method="POST" enctype="multipart/form-data"
                >
                    <h2><b>Book Information</b></h2>
                    <p class="form-label">Book ID : <?
                        echo $this->data['book_id'];
                    ?></p>
                    <p class="form-label">Title : <?
                        echo $this->data['title'];
                    ?></p>
                    <p class="form-label">Year Published : <?
                        echo $this->data['year'];
                    ?></p>
                    <p class="form-label">Authors : <?
                        echo $this->data['authors'];
                    ?></p>
                    <p class="form-label">Genres : <?
                        echo $this->data['genres'];
                    ?></p>
                    <p class="form-label">Price : <?
                        echo $this->data['price'];
                    ?></p>
                    <p class="form-label">Summary : <?
                        echo $this->data['summary'];
                    ?></p>


                    <input type="submit" class="button green-button" value="Delete">

                </form>
            </div>
        </div>
    </div>
</body>

</html>