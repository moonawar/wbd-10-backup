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
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/admin/crud-page.css">
    <title>Update Author : <? echo $this->data['author_id'];?></title>
</head>

<body>
    <!-- Navigation bar -->
    <?php include(dirname(__DIR__) . '../../components/Navbar.php') ?>
    <div class="wrapper-small">
        <h1>Update author Page</h1>
        <div class="pad-40">
            <div class="centered">
                <form  
                    class="center-contents"
                    action="/author/delete/<? $this->data['author_id'] ?>" method="DELETE" enctype="multipart/form-data"
                >
                    <p class="form-label">Author ID : <?
                        echo $this->data['author_id'];
                    ?></p>
                    <p class="form-label">Name : <?
                        echo $this->data['full_name'];
                    ?></p>
                    <input type="submit" class="button green-button" value="Delete">

                </form>
            </div>
        </div>
    </div>


    </div>

</body>

</html>