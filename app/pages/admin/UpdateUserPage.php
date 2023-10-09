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
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/admin/crud-page.css">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/admin/list.css">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/home/home.css">
    <title>Update User</title>
</head>

<body>
    <!-- Navigation bar -->
    <?php include(dirname(__DIR__) . '../../components/Navbar.php') ?>
    <div class="content">
        <h1>User List</h1>

        <table border="1">
            <tr>
                <th>Username</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
            <?php
            
            $users = $this->data['users'];

            foreach ($users as $user) {
                echo "<tr>";
                echo "<td>" . $user['username'] . "</td>";
                echo "<td>" . $user['role'] . "</td>";
                echo '<td><a href="/user/update/' . $user['username'] . '">Edit</a></td>';
                echo "</tr>";
            }
            ?>
        </table>
        <div class="pagination vert-m-50">

            <?
            $page = $this->data['page'];
            $maxPage = $this->data['totalPages'];
            $prevPage = $page - 1;
            
            echo '<a class="arrow-wrapper href=/user/update?page=' . $prevPage . '">
            <img class="page-arrow" src="http://localhost:8000/public/icon/left-arrow.svg" alt="left-arrow" />
            </a>';
            

            $topPage = $page + 10;
            if ($topPage > $maxPage) {
                $topPage = $maxPage;
            }
            
            for ($i = 1; $i <= $maxPage; $i++) {
                if ($i == $page) {
                    echo '<a href="/user/update?page=' . $i . '" class="page-btn"><b>' . $i . '</b></a>';
                } else {
                    echo '<a href="/user/update?page=' . $i . '" class="page-btn"><div class="">' . $i . '</div></a>';
                }
            }

            $nextPage = $page + 1;
            echo '<a class="arrow-wrapper href=/user/update?page=' . $nextPage . '">
            <img class="page-arrow" src="http://localhost:8000/public/icon/right-arrow.svg" alt="right-arrow" />
            </a>';


            // for ($i = 1; $i <= $maxPage; $i++) {
            //     if ($i == $page) {
            //         echo '<div class="green-reverse-button inner-box">' . $i . '</div>';
            //     } else {
            //         echo '<a href="/user/list/' . $i . '"><div class="green-reverse-button inner-box">' . $i . '</div></a>';
            //     }
            // }

            $nextPage = $page + 1;
            
            ?>

            <!-- <button class="arrow-wrapper" type="button">
                <img class="page-arrow" src="<?= BASE_URL ?>/icon/left-arrow.svg" alt="left-arrow" />
            </button>
            <div class="green-reverse-button inner-box">
                1
            </div>
            <div class="green-reverse-button inner-box">
                2
            </div>
            <button class="arrow-wrapper" type="button">
                <img class="page-arrow" src="<?= BASE_URL ?>/icon/right-arrow.svg" alt="left-arrow" />
            </button> -->
        </div>
    </div>
</body>

</html>