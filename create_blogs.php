<?php

//check if user login if not then redirect it in index.php
include("./config/protected_routes.php");

?>

<!DOCTYPE html>
<html lang="en">

<!-- header -->
<?php include("./templates/header.php") ?>

<main class="Create Blogs" id="create_blogs">
    <form class="create-blogs-section" id="create-blogs-section">


    </form>
    <section class="create-blogs-options" id="create-blog-button">
        <div class="add_blogs_buttons">
            <img class="add_icon" src="./assets/icons/add_gray.svg">
            <p>Introduction</p>

        </div>
        <div class="add_blogs_buttons">
            <img class="add_icon" src="./assets/icons/add.svg">
            <p>Header</p>
        </div>
        <div class="add_blogs_buttons">
            <img class="add_icon" src="./assets/icons/add.svg">
            <p>Paragraph</p>
        </div>
        <div class="add_blogs_buttons">
            <img class="add_icon" src="./assets/icons/add.svg">
            <p>Image</p>
        </div>
        <div class="add_blogs_buttons">
            <img class="add_icon" src="./assets/icons/add.svg">
            <p>Section</p>
        </div>
    </section>

</main>


<!-- footer -->
<?php include("./templates/footer.php") ?>

<script src="./scripts/create_blogs.js"></script>

</html>