<header class="topnav">
    <a href="/index.php"><button>Homepage</button></a>
    <?php
        if (!empty($_SESSION['email'])) {
            echo '<button><a href="/logout/logout.php">Logout</a></button>';
        }
        else {
            echo '<button><a href="/login/login_page.php">Login</a></button>';
        }
    ?>
</header>