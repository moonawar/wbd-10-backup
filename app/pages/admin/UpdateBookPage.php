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
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/admin/list.css">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/admin/crud-page.css">
    <title>Update Book : <? echo $this->data['book_id'];?></title>
</head>

<body>
    <!-- Navigation bar -->
    <?php include(dirname(__DIR__) . '../../components/Navbar.php') ?>
    <div class="wrapper-small">
        <div class="pad-40">
                <h1>Update Book Page</h1>
                <form  
                    action="/book/update/<? echo $this->data['book_id']?>" method="POST" enctype="multipart/form-data"
                >
                    <h2><b>Old Information</b></h2>
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
                    
                    <input type="hidden" name="old" value=<?$this->data?>>

                    <br>
                    <label class="form-label" for="title">New Book Title:</label><br>
                    <input class="form-field" type="text" id="title" name="title">

                    <br><br>

                    <label class="form-label" for="year">New Book Published Year:</label><br>
                    <input class="form-field" type="number" id="year" name="year">

                    <br><br>

                    <label class="form-label" for="genre">New Book Price:</label><br>
                    <input class="form-field" type="number" id="genre" name="genre">

                    <br><br>

                    <label class="form-label" for="summary">New Book Summary:</label><br>
                    <textarea 
                        class="text-area" type="text" id="summary" name="summary" 
                        rows="5" cols="50"
                    > </textarea>

                    <!-- <label class="file-upload form-label" for="cover">New Book Cover:</label>
                    <input type="file" id="image" name="cover" accept="image/png, image/jpeg">

                    <label class="file-upload form-label" for="audio">New Audio:</label>
                    <input type="file" id="audio" name="audio" accept="audio/mpeg"> -->

                    <br><br>

                    <input type="submit" class="button green-button" value="Update">

                </form>
        </div>
    </div>
</body>

</html>