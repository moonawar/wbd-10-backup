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
        <h1><?php echo $this->data['username']?>'s Subscription</h1>
        <!-- Todo Routing -->
        <a href="/premium">+ Add Subscription</a>  
        <?php
            if (count($this->data['subscription']) > 0) {
                echo "<table border=\"1\" class=\"styled-table\">";
                echo "<thead>";
                echo "<tr>";
                echo "<th>Curator Name</th>";
                echo "<th>Action</th>";
                echo "</tr>";
                echo "</thead>";
            } else {
                echo "<h2>You have no subscription</h2>";
            }
        ?>
  
            <?php
            if (count($this->data['subscription']) > 0) {
                $subs = $this->data['subscription']['item'];

                foreach ($subs as $sub) {

                    $raw_data = file_get_contents('http://host.docker.internal:8040/api/curator/' . $sub['curator']);
                    $data = json_decode($raw_data, true);
                    $colId = $data['collectionId'];

                    echo "<tr>";
                    echo "<td>" . $sub['curator'] . "</td>";
                    echo '<td><a href="/premium/detail/' . $colId . '">Details</a></td>';
                    echo "</tr>";
                }
            }

            ?>
        </table>
    </div>
</body>

</html>