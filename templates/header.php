<?php


$username = $_SESSION["user"] ?? "@email.com";
$isLogin = $_SESSION["isLogin"] ?? false;



if (isset($_POST['account'])) {
}

if (isset($_POST['logout'])) {
    //remove user email in session
    unset($_SESSION['user']);
    $_SESSION['isLogin'] = false;
    header("Location:./index.php");
}

?>


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recently</title>
    <link rel="stylesheet" href="./styles/header.css">
</head>


<body id="landing-page">

    <nav class="nav-container">
        <ul class="nav-items">
            <li>
                <a href="#">
                    <img class="nav-logo" src="./assets/imgs/blogs_logo.svg">
                </a>
            </li>
            <li id="link-items">
                <a href="./home.php">Home</a>
                <a href="./featured.php">Featured</a>
                <a href="./categories.php">Categories</a>
                <a href="./create_blogs.php">Create Blogs</a>
            </li>
            <li id="login-signup">
                <p id="user-account"><?php echo htmlspecialchars($username) ?></p>
                <div id="login-signup-container">
                    <a href="./templates/forms/signup.php">Sign Up</a>
                    <a href="./templates/forms/login.php">Login</a>
                    <img class=" menu-icon" src="./assets/icons/menu.svg" id="menu-icon-button">
                </div>

            </li>
        </ul>
    </nav>

    <div id="user-actions">
        <a href="./home.php">Home</a>
        <a href="./featured.php">Featured</a>
        <a href="./categories.php">Categories</a>
        <a href="./create_blogs.php">Create Blogs</a>
        <a href="./account_page.php">Account</a>
        <form action="" method="post">
            <input type="submit" name="logout" value="Logout">
        </form>
    </div>


    <div class="nav-menu" id="nav-container">
        <ul>
            <li>
                <a href="">Home</a>
                <a href="">Featured</a>
                <a href="">Categories</a>
                <a href="">Account</a>
                <a href="">Logout</a>
            </li>
        </ul>
    </div>



    <script src="./scripts/header.js"></script>