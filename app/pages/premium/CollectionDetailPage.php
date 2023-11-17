<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="wibook_dth=device-width, initial-scale=1.0">
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
    <title>Curator's Collection</title>
</head>

<body>
    <!-- Navigation bar -->
    <?php include(dirname(__DIR__) . '../../components/Navbar.php') ?>
    <div class="content">
        <h1>Curator's Collection</h1>
        <a href="/book/add">+ Subscribe</a>  
        <table border="1" class="styled-table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Book Title</th>
                    <th>Author</th>
                    <!-- Todo tambah boolean kalo dia ud subscribe bs buka detail -->
                    <th>Details</th>
                </tr>
            </thead>
            <?php
            $collectionId = $this->data['collectionId'];
            $raw_data = file_get_contents("http://host.docker.internal:8040/api/curator-collection/$collectionId");
            $data = json_decode($raw_data, true);
            $books = $data['books'];

            foreach (($books) as $index => $book) {
                echo "<tr>";
                echo "<td>" . $index+1 . "</td>";
                echo "<td>" . $book['title'] . "</td>";
                echo "<td>" . $book['author'] . "</td>";
                echo '<td><a href="/premium/book/' . $book['book_id'] .'">Details</a></td>';
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</body>

</html>