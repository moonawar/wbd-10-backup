<!DOCTYPE html>
<html>

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
    <title>Update author</title>
</head>

<body>
    <!-- Navigation bar -->
    <?php include(dirname(__DIR__) . '../../components/Navbar.php') ?>
    <div class="content">
        <h1>Author List</h1>

        <table border="1">
            <tr>
                <th>Id</th>
                <th>Full Name</th>
                <th>Age</th>
                <th>Edit?</th>
                <th>Delete?</th>
            </tr>
            <?php
            
            $authors = $this->data['authors'];

            foreach ($authors as $author) {
                echo "<tr>";
                echo "<td>" . $author['author_id'] . "</td>";
                echo "<td>" . $author['full_name'] . "</td>";
                echo "<td>" . $author['age'] . "</td>";
                echo '<td><a href="/author/update/' . $author['author_id'] .'">Edit</a></td>';
                echo '<td><a href="/author/delete/' . $author['author_id'] . '">Delete</a></td>';
                echo "</tr>";
            }
            ?>
        </table>
        <div class="pagination vert-m-50">

            <?
            $page = $this->data['page'];
            $maxPage = $this->data['totalPages'];
            $prevPage = $page - 1;
            
            echo '<a class="arrow-wrapper href=/author/update?page=' . $prevPage . '">
            <img class="page-arrow" src="http://localhost:8000/public/icon/left-arrow.svg" alt="left-arrow" />
            </a>';
            

            $topPage = $page + 10;
            if ($topPage > $maxPage) {
                $topPage = $maxPage;
            }
            
            for ($i = 1; $i <= $maxPage; $i++) {
                if ($i == $page) {
                    echo '<a href="/author/update?page=' . $i . '" class="page-btn"><b>' . $i . '</b></a>';
                } else {
                    echo '<a href="/author/update?page=' . $i . '" class="page-btn"><div class="">' . $i . '</div></a>';
                }
            }

            $nextPage = $page + 1;
            echo '<a class="arrow-wrapper href=/author/update?page=' . $nextPage . '">
            <img class="page-arrow" src="http://localhost:8000/public/icon/right-arrow.svg" alt="right-arrow" />
            </a>';


            // for ($i = 1; $i <= $maxPage; $i++) {
            //     if ($i == $page) {
            //         echo '<div class="green-reverse-button inner-box">' . $i . '</div>';
            //     } else {
            //         echo '<a href="/author/list/' . $i . '"><div class="green-reverse-button inner-box">' . $i . '</div></a>';
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