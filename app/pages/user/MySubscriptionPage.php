<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="wiauthor_dth=device-width, initial-scale=1.0">
    <link rel="icon" sizes="180x180" href="<?= BASE_URL ?>/icon/favicon-110.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= BASE_URL ?>/icon/favicon-32.png">
    <!-- Global CSS -->
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/template/globals.css">
    <!-- Navbar CSS -->
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/template/navbar.css">
    <!-- Page-specific CSS -->
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/admin/crud-page.css">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/admin/list.css">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/home/home.css">
    <title>My Subscription</title>
</head>

<body>
    <!-- Navigation bar -->
    <?php include(dirname(__DIR__) . '../../components/Navbar.php') ?>
    <div class="content">
        <h1><?php $this->data['username']?>'s Subscription</h1>
        <!-- Todo Routing -->
        <a href="/premium">++ Add Subscription</a>  
        <table border="1" class="styled-table">
            <thead>
                <tr>
                    <th>Curator Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <?php
            
            $authors = $this->data['authors'];

            foreach ($authors as $author) {
                echo "<tr>";
                echo "<td>" . $author['full_name'] . "</td>";
                echo '<td><a href="/author/update/' . $author['author_id'] .'">Pending/Details</a></td>';
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</body>

</html>