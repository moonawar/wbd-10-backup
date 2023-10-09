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
    <title>Update User : <? echo $this->data['genre_id'];?></title>
</head>

<body>
    <!-- Navigation bar -->
    <?php include(dirname(__DIR__) . '../../components/Navbar.php') ?>
    <div class="wrapper-small">
        <div class="pad-40">
                <h1>Update Genre Page</h1>
                <form  
                    action="/genre/update/<? echo $this->data['genre_id']?>" method="POST" enctype="multipart/form-data"
                >
                    <p class="form-label">Genre ID : <?
                        echo $this->data['genre_id'];
                    ?></p>
                    <p class="form-label">Previous Genre Name : <?
                        echo $this->data['name'];
                    ?></p>
                    
                    <br>
                    <label class="form-label" for="name">New Genre Name:</label><br>
                    <input class="form-field" type="text" id="name" name="name" required>

                    <br><br>

                    <input type="submit" class="button green-button" value="Update">

                </form>
        </div>
    </div>
</body>

</html>