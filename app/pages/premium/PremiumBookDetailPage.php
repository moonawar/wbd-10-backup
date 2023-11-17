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
    <title>Premium: <?=$this->data['title']?></title>
</head>
<body>
    <!-- Navigation bar -->
    <?php include(dirname(__DIR__) . '../../components/Navbar.php') ?>
    <div class="container">
        <?php if(isset($this->data['bookId']) ):?>
        <h2>PREMIUM DETAILS</h2>
        <?php 
          $bookId = $this->data['bookId'];
          $raw_data = file_get_contents("http://host.docker.internal:8040/api/book-collection/$bookId");
          $data = json_decode($raw_data, true);
          $book = $data['book'];

          echo "<h3> Title: ". $book['title'] ."</h3>";
          echo "<h4> Author: ". $book['createdBy'] ."</h4>";
          echo "<h4> Year: ". $book['year'] ."</h4>";
            echo "<h4> Genre:". $book['genre'] ."</h4>";
            echo "<text>". $book['content'] ."</text>";
            echo "<h5>Duration: ". $book["duration"] ."</h5>";          
        ?>
        <?php else : ?>
        <h2 class="info">Can't find the book you're looking for!</h2>
        <?php endif; ?>
    </div>
</body>
</html>.