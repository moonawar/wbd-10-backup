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
    <title>Premium Collection</title>
</head>

<body>
    <!-- Navigation bar -->
    <?php include(dirname(__DIR__) . '../../components/Navbar.php') ?>
    <div class="content">
        <h1>Premium Book Collection</h1>
        <table border="1" class="styled-table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Curator Collection</th>
                    <th>Details</th>
                    <th>Subscribe</th>
                </tr>
            </thead>
            <?php
            $raw_data = file_get_contents('http://host.docker.internal:8040/api/curator-collection');
            $data = json_decode($raw_data, true);
            // echo var_dump($data);
            $collections = $data['found'];

            foreach ($collections as $collection) {
                echo "<tr>";
                echo "<td>" . $collection['collectionId'] . "</td>";
                echo "<td>" . $collection['createdBy'] . "</td>"; 
                echo '<td><a href="/premium/detail/' . $collection['collectionId'] .'">Details</a></td>';
                echo '<td><a href="/premium/detail/' . $collection['collectionId'] .'">Subscribe</a></td>';
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</body>

</html>