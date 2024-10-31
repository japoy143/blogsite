<?php

//check if user login if not then redirect it in index.php
include("./config/protected_routes.php");

include("./config/db_conn.php");

$stmt = $conn->prepare("SELECT * FROM blog_position ORDER BY created_at");
$stmt->execute();
$result = $stmt->get_result();
$allblogs = $result->fetch_all(MYSQLI_ASSOC);



//categories
$categories = [
    '0' => 'Introduction',
    '1' => 'Header',
    '2' => 'Paragraph',
    '3' => 'Image',
    '4' => 'Section'
];

?>

<!DOCTYPE html>
<html lang="en">

<!-- header -->
<?php include("./templates/header.php") ?>

<main class="Categories">
    <div class="search-blogs-container">
        <form class="search-container" method="post">
            <input name="search" placeholder="Search blogs" type="text" id="search_id">
            <img src="./assets/icons/search.svg" />

        </form>

    </div>
    <div class="categories-wrapper">
        <div class="categories-container">

            <?php
            $stmt = $conn->prepare("SELECT DISTINCT category FROM introduction");
            $stmt->execute();
            $result = $stmt->get_result();
            $data = $result->fetch_all(MYSQLI_ASSOC);

            array_unshift($data, ['category' => 'all']);
            foreach ($data as $category):
            ?>
                <div class="categories-selection-label ">
                    <p><?php echo htmlspecialchars($category['category']) ?></p>
                </div>

            <?php
            endforeach;

            ?>

        </div>
    </div>
    <div id="search-filter">

    </div>

    <div class="categories-blog-list" id="categories-blog-list">


    </div>


</main>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#search_id").keyup(function() {
            var inputValue = $(this).val().trim();

            $.ajax({
                type: 'POST',
                url: './templates/livesearch.php',
                data: {
                    input: inputValue
                },
                success: function(data) {
                    $("#categories-blog-list").html(data);
                    $("#search-filter").css("display", "none");
                }
            });
        });

        // Initial load
        //get data from  ./templates/livesearch.php
        //then put the data in id  categories-blog-list
        $.ajax({
            type: 'GET',
            url: './templates/livesearch.php',
            success: function(data) {
                $("#categories-blog-list").html(data);
            }
        });
    });

    $(".categories-selection-label").click(function() {
        //reset all color
        $(".categories-selection-label ").css("color", "inherit");
        var tappedCategory = $(this).text().trim();

        if (tappedCategory === 'all') {
            tappedCategory = '';
        }


        //ensure that tapped will have this color
        $(this).css("color", "#e78f81");



        $.ajax({
            type: 'POST',
            url: './templates/livesearch.php',
            data: {
                input: tappedCategory
            },
            success: function(data) {
                $("#categories-blog-list").html(data);
                $("#search-filter").css("display", "none");

            }
        });
    })
</script>


<!-- footer -->
<?php include("./templates/footer.php") ?>

</html>