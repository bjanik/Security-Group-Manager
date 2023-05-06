<header class="topnav">
    <a href="/index.php"><button>Homepage</button></a>
    <div class="header-right">
        <?php
        if (!empty($_SESSION['email'])) {
            echo "<div>{$_SESSION['email']}</div>";
            echo "<a href='/user/logout.php'><button>Logout</button></a>";
        }
        else {
            echo "<div>";
            echo "<a href=/user/sign_up_page.php><button>Sign-up</button></a>";
            echo "<a href=/user/login_page.php><button>Login</button></a>";
            echo "</div>";
        }
        ?>
    </div>
</header>