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
    <title><?=$this->data['title']?></title>
</head>
<body>
    <!-- Navigation bar -->
    <?php include(dirname(__DIR__) . '../../components/Navbar.php') ?>
    <div class="container">
        <?php if(isset($this->data['book_id']) ):?>
        <h2>DETAILS</h2>
        <!-- Book Cover -->
        <img src="<?= BASE_URL ?>/<?= str_replace('/var/www/html/config/', '', $this->data['cover_path']) ?>" alt ="book-cover"/>
        <div class="details-container">
        <!-- Book Title -->
        <h3> <?=$this->data['title']?> </h3>

        <!-- Author Genre Year-->
        <h4> <?=$this->data['authors']?></h4>
        <h4> <?=$this->data['genres']?></h4>
        <h4> <?=$this->data['year']?></h4>
        <h4> <?=$this->data['lang']?></h4>
        <h5> Duration: <?=$this->data['duration']?> sec</h5>
        <h5> Price: Rp<?=$this->data['price']?></h5>

        <!-- Decription -->
        <p>  <?=$this->data['summary']?></p>

        <!-- check ownership -->
        <?php
            if(isset($this->data['username'])):
            if(isset($this->data['own'])):
                
            $bookIdToCheck = $this->data['book_id'];
            $found = false;

            foreach ($this->data['own'] as $ownedBook) {
                if (isset($ownedBook['book_id']) && $ownedBook['book_id'] == $bookIdToCheck) {
                    $found = true;
                    break;
                }
            }
            if($found):
        ?>
        <audio controls>
            <source src="<?= BASE_URL ?>/<?= str_replace('/var/www/html/config/', '', $this->data['audio_path']) ?>" alt ="book-audio" type="audio/mp3">
            Your browser does not support the audio element.
        </audio>
        <?php endif; ?>
        <?php endif; ?>
        <?php endif; ?>
        </div>
        <?php else : ?>
        <h2 class="info">Can't find the book you're looking for!</h2>
        <?php endif; ?>
    </div>
</body>
</html>.