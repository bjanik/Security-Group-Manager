<header class="topnav">
    <a href="/index.php"><button>Homepage</button></a>
    <?php
        if (!empty($_SESSION['login'])) {
            echo '<a href="/logout/logout.php"><button>Logout</button></a>';
        }
        else {
            echo '<a href="/login/login.html"><button>Login</button></a>';
        }
    ?>
</header>