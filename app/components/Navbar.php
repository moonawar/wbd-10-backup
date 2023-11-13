
    <nav class="teal-bar">
        <input type="checkbox" id="check">
        <label for="check">
        <img src="<?= BASE_URL ?>/icon/close.svg" alt="Close menu" width="3%" id="btn">
            <img src="<?= BASE_URL ?>/icon/menu.svg" alt="menu icon" width="3%" id="open">
        </label>
        <div class="sidebar closed">
            <div class="top">
            <img src="<?= BASE_URL ?>/images/white-logo.svg" alt="White Logo" width="80%">
            </div>  
            <ul>
                <li>
                    <a class="book-list" href="/book">
                        <img src="<?= BASE_URL ?>/icon/home.svg" alt="Home Icon"> 
                        Book List
                    </a>
                </li>
                <?php if(isset($_SESSION['username'])):?>
                <?php if($_SESSION["role"]=='admin') :?>
                <li>
                    <a class="customer" href="/user/update">
                        <img src="<?= BASE_URL ?>/icon/dashboard.svg" alt="Customer Icon">
                        Users
                    </a>
                </li>
                <li>
                    <a class="genre" href="/genre/update">
                        <img src="<?= BASE_URL ?>/icon/genre.svg" alt="Genre Icon"> 
                        Genres
                    </a>
                </li>
                <li>
                    <a class="author" href="/author/update">
                        <img src="<?= BASE_URL ?>/icon/author.svg" alt="Author Icon">
                        Author
                    </a>
                </li>
                <?php endif;?>
                <?php endif;?>
            </ul>
            <?php if(isset($_SESSION['username'])):?>
                <form method="POST"
                        action="/../user/logout"  >
                        <input class="section" type="submit" value="Log Out"> </input>
                </form>
                <?php else : ?>
                    <form method="GET"
                        action="/../user/login"  >
                        <input class="section login" type="submit" id ="login" value="Log In"> </input>
                </form>
            <?php endif;?>
        </div>
    </nav>
