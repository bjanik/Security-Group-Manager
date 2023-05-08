<header class="topnav">
    <a href="/index.php"><button>Homepage</button></a>
    <div class="header-right">
        <?php
            if (!empty($_SESSION['email'])) {
                echo "<div>{$_SESSION['email']}</div>";
                echo "<a href='/user/sign_out.php'><button>Sign out</button></a>";
            }
            else {
                echo "<a href=/user/sign_up_page.php><button>Sign up</button></a>";
                echo "<a href=/user/sign_in_page.php><button>Sign in</button></a>";
            }
        ?>
    </div>
</header>
</br></br>