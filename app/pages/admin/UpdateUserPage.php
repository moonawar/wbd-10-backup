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
        <table border="1" class = "styled-table">
        <thead>
            <tr>
                <th>Username</th>
                <th>Role</th>
                <th>Edit?</th>
                <th>Delete?</th>
            </tr>
        </thead>
            <?php
            
            $users = $this->data['users'];

            foreach ($users as $user) {
                echo "<tr>";
                echo "<td>" . $user['username'] . "</td>";
                echo "<td>" . $user['role'] . "</td>";
                echo '<td><a href="/user/update/' . $user['username'] .'">Edit</a></td>';
                echo '<td><a href="/user/delete/' . $user['username'] .'">Delete</a></td>';
                echo "</tr>";
            }
            ?>
        </table>
        <div class="pagination vert-m-50">

            <?
            $page = $this->data['page'];
            $maxPage = $this->data['totalPages'];
            $prevPage = $page - 1;
            
            $topPage = $page + 10;
            if ($topPage > $maxPage) {
                $topPage = $maxPage;
            }
            
            for ($i = 1; $i <= $topPage; $i++) {
                if ($i == $page) {
                    echo '<a href="/user/update?page=' . $i . '" class="page-btn"><b>' . $i . '</b></a>';
                } else {
                    echo '<a href="/user/update?page=' . $i . '" class="page-btn"><div class="">' . $i . '</div></a>';
                }
            }

            $nextPage = $page + 1;
            
            ?>
        </div>
    </div>
</body>

</html>