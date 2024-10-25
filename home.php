<?php

//check if user login if not then redirect it in index.php
include('./config/protected_routes.php');

include('./config/db_conn.php');

$sql = 'SELECT * FROM blog_position ORDER BY created_at';

$result = mysqli_query($conn, $sql);

$allblogs = mysqli_fetch_all($result, MYSQLI_ASSOC);

print_r($allblogs);

mysqli_free_result($result);

$post_id = $allblogs[0]['post_id'];

//get the first post 
if ($allblogs) {
    $sql = "SELECT * FROM introduction WHERE post_id=$post_id";
    $result = mysqli_query($conn, $sql);

    $featured_blog = mysqli_fetch_assoc($result);

    print_r($featured_blog);
}


//categories
$categories = [
    '0' => 'Introduction',
    '1' => 'Header',
    '2' => 'Paragraph',
    '3' => 'Image',
    '4' => 'Section'
];




//loop to all blog using 
//blogposition




?>


<!DOCTYPE html>
<html lang="en">

<!-- header -->
<?php include("./templates/header.php") ?>

<main class="Home">

    <div class="today-blog">
        <div class="blog-first-container">
            <div></div>
            <div class="first-featured-blog-container">
                <h2><?php echo htmlspecialchars($featured_blog['title']) ?></h2>
                <div class="blog-img-container">
                    <img src="<?php echo htmlspecialchars($featured_blog['image_path']) ?>" class="blog-image-size">
                </div>
            </div>
            <div class="second-featured-blog-container">
                <h4>
                    <?php echo htmlspecialchars($featured_blog['category']) ?>
                </h4>

                <h2> <?php echo htmlspecialchars($featured_blog['subtitle']) ?></h2>
                <p><?php echo htmlspecialchars($featured_blog['body']) ?></p>
            </div>
            <div></div>
        </div>
        <div class="blog-second-container">

            <?php
            $counter = 0;
            foreach ($allblogs as $pos) :


                $currentPostion = $pos['placement'];
                $current_post_id = $pos['post_id'];


                if ($currentPostion == "") {

                    $sql = "SELECT * FROM introduction WHERE post_id=$current_post_id";
                    $introductionresult = mysqli_query($conn, $sql);

                    $FirstintroductionData = mysqli_fetch_assoc($introductionresult);

            ?>
                    <!-- only introduction -->
                    <div class="blog-list-container">
                        <h2><?php echo $FirstintroductionData['title'] ?></h2>
                        <div class="blog-list-image-container">
                            <img src="<?php echo $FirstintroductionData['image_path'] ?>" class="image-blog" />
                        </div>
                        <p><?php echo $FirstintroductionData['body'] ?></p>

                    </div>


            <?php  } else {
                    $split_postions = explode(',', $currentPostion);




                    foreach ($split_postions as $pos) {
                        if ($counter == 0) {
                            $counter++;
                            continue; // Skip the first iteration
                        }

                        switch ($categories[$pos]) {
                            case 'Introduction':

                                $sql = "SELECT * FROM introduction WHERE post_id=$current_post_id";
                                $introductionListresult = mysqli_query($conn, $sql);
                                $introductionListData = mysqli_fetch_assoc($introductionListresult);



                                echo  "<div class='blog-list-container'>";
                                echo "<h2>" . $introductionListData['title'] . "</h2>";
                                echo  "<div class='blog-list-image-container'>";
                                echo '<img src="' . $introductionListData['image_path'] . '" class="image-blog" />';

                                echo "</div>";
                                echo "<p>" . $introductionListData['body'] . "</p>";

                                echo "</div>";

                                break;
                            case 'Header':
                                $sql = "SELECT * FROM header WHERE post_id=$current_post_id";
                                $headerListResult = mysqli_query($conn, $sql);
                                $headerListData = mysqli_fetch_assoc($headerListResult);

                                echo "<div class='blog-list-container'>";
                                echo "<h2 class='header-section'>" . $headerListData['header'] . "</h2>";
                                echo "</div>";

                                break;

                            case 'Paragraph':
                                $sql = "SELECT * FROM paragraph WHERE post_id=$current_post_id";
                                $paragraphListResult = mysqli_query($conn, $sql);
                                $paragraphListData = mysqli_fetch_assoc($paragraphListResult);

                                echo "<div class='blog-list-container'>";
                                echo "<p>" .  $paragraphListData['paragraph'] . "</p>";
                                echo "</div>";

                                break;

                            case 'Image':
                                $sql = "SELECT * FROM image WHERE post_id=$current_post_id";
                                $imageListresult = mysqli_query($conn, $sql);
                                $imageListData = mysqli_fetch_assoc($imageListresult);


                                echo  "<div class='blog-list-image-section-container'>";
                                echo '<img src="' . $imageListData['image'] . '" class="image-blog" />';

                                echo "</div>";
                                break;

                            case 'Section':
                                $sql = "SELECT * FROM section WHERE post_id=$current_post_id";
                                $sectionListResult = mysqli_query($conn, $sql);
                                $sectionListData = mysqli_fetch_assoc($sectionListResult);



                                echo  "<div class='blog-list-container'>";
                                echo "<h2>" . $sectionListData['sectiontitle'] . "</h2>";
                                echo  "<div class='blog-list-image-container'>";
                                echo '<img src="' . $sectionListData['sectionimage'] . '" class="image-blog" />';

                                echo "</div>";
                                echo "<p>" . $sectionListData['sectioncontent'] . "</p>";

                                echo "</div>";
                                break;
                        }
                    }
                }


            endforeach;

            ?>

        </div>
    </div>


</main>

<!-- footer -->
<?php include("./templates/footer.php") ?>

</html>