<?php
include("./models/blogType.php");

?>



<!DOCTYPE html>
<html lang="en">

<!-- header -->
<?php include("./templates/header.php") ?>

<main class="landing-container">
    <div class="landing-content">
        <h1>Share your <span id="recent">recent</span> thoughts</h1>
        <p>Express your ideas by creating blogs easily. Read interesting blogs.</p>
        <a class="create-blogs-button" href="./templates/forms/login.php">Create blogs now</a>
    </div>
    <div class="bg-content">
        <div class="first-bg">
            <img src="./assets/imgs/bg_circles.svg" class="circles" alt="">
            <img src="./assets/imgs/bg_circles.svg" class="circles" alt="">
        </div>
        <div class="second-bg">
            <img src="./assets/imgs/bg_circles.svg" class="circles" alt="">
            <img src="./assets/imgs/bg_circles.svg" class="circles" alt="">
        </div>

    </div>
</main>

<!-- footer -->
<?php include("./templates/footer.php") ?>

</html>