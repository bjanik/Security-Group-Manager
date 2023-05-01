<header class="topnav">
    <a href="/index.php"><button>Homepage</button></a>
    <div class="header-right">
        <?php
        if (!empty($_SESSION['email'])) {
            echo "<div>{$_SESSION['email']}</div>";
            echo "<a href='/logout/logout.php'><button>Logout</button></a>";
        }
        else {
            echo "<a href=/login/login_page.php><button>Login</button></a>";
        }
        ?>
    </div>
</header>