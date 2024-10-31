<?php

include('../config/db_conn.php');


if (isset($_POST['input']) && $_POST['input'] !== '') {
    $input = $_POST['input'];


    $stmt = $conn->prepare("SELECT post_id FROM introduction WHERE category LIKE ? OR title LIKE ? ");
    // Add wildcards for pattern matching
    $inputWithWildcards = "{$input}%";

    $stmt->bind_param("ss", $inputWithWildcards, $inputWithWildcards);
    $stmt->execute();
    $result = $stmt->get_result();
    $all_ids = $result->fetch_all(MYSQLI_ASSOC);



    $all_positions = [];

    //get all blog_positions
    foreach ($all_ids as $ids) {
        $stmt = $conn->prepare("SELECT * FROM blog_position WHERE post_id = ?");
        $stmt->bind_param("i", $ids['post_id']);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();

        $all_positions[] = $data;
    }




    if (empty($all_positions)) {
        echo "<div><h2>
        No Such Blog Exist
        </h2></div>";
    }



    //categories
    $categories = [
        '0' => 'Introduction',
        '1' => 'Header',
        '2' => 'Paragraph',
        '3' => 'Image',
        '4' => 'Section'
    ];

    //remove empty array
    $filteredArray = array_filter($all_positions, function ($value) {
        return !empty($value);
    });



    foreach ($filteredArray as $pos) :


        $currentPostion = $pos['placement'];
        $current_post_id = $pos['post_id'];


        if ($currentPostion == "") {

            $sql = "SELECT * FROM introduction WHERE post_id=$current_post_id";
            $introductionresult = mysqli_query($conn, $sql);

            $FirstintroductionData = mysqli_fetch_assoc($introductionresult);



            echo  " <div class='blog-list-container'>";
            echo "  <h2>" . $FirstintroductionData['title'] . "</h2>";
            echo " <div class='blog-list-image-container-categories'>";
            echo      "<img src=" . $FirstintroductionData['image_path'] . " class='image-blog-categories' />";
            echo " </div>";
            echo "<p>" . $FirstintroductionData['body'] . "</p>";

            echo " </div>";
        } else {
            $split_postions = explode(',', $currentPostion);



            foreach ($split_postions as $pos) {


                switch ($categories[$pos]) {
                    case 'Introduction':

                        $stmt = $conn->prepare("SELECT * FROM introduction WHERE post_id=?");
                        $stmt->bind_param("i", $current_post_id);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $introductionListData = $result->fetch_assoc();


                        echo  "<div class='blog-list-container'>";
                        echo "<h2>" . $introductionListData['title'] . "</h2>";
                        echo "<p>" . $formatted_date = date('F j, Y', strtotime($introductionListData['created_at']));
                        echo htmlspecialchars($formatted_date) . "</p>";

                        echo  "<div class='blog-list-image-container-categories'>";
                        echo '<img src="' . $introductionListData['image_path'] . '" class="image-blog-categories" />';

                        echo "</div>";
                        echo "<p>" . $introductionListData['body'] . "</p>";

                        echo "</div>";

                        break;
                    case 'Header':
                        $stmt = $conn->prepare("SELECT * FROM header WHERE post_id=?");
                        $stmt->bind_param("i", $current_post_id);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $headerListData = $result->fetch_assoc();;

                        echo "<div class='text-list-container'>";
                        echo "<h2 class='header-section'>" . $headerListData['header'] . "</h2>";
                        echo "</div>";

                        break;

                    case 'Paragraph':
                        $stmt = $conn->prepare("SELECT * FROM paragraph WHERE post_id=?");
                        $stmt->bind_param("i", $current_post_id);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $paragraphListData = $result->fetch_assoc();



                        echo "<div class='text-list-container'>";
                        echo "<p>" .  $paragraphListData['paragraph'] . "</p>";
                        echo "</div>";

                        break;

                    case 'Image':
                        $stmt = $conn->prepare("SELECT * FROM image WHERE post_id=?");
                        $stmt->bind_param("i", $current_post_id);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $imageListData = $result->fetch_assoc();


                        echo  "<div class='blog-list-image-section-container'>";
                        echo '<img src="' . $imageListData['image'] . '" class="image-blog-categories" />';

                        echo "</div>";
                        break;

                    case 'Section':
                        $stmt = $conn->prepare("SELECT * FROM section WHERE post_id=?");
                        $stmt->bind_param("i", $current_post_id);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $sectionListData = $result->fetch_assoc();

                        echo  "<div class='blog-list-container'>";
                        echo "<h2>" . $sectionListData['sectiontitle'] . "</h2>";
                        echo  "<div class='blog-list-image-container-categories'>";
                        echo '<img src="' . $sectionListData['sectionimage'] . '" class="image-blog-categories" />';

                        echo "</div>";
                        echo "<p>" . $sectionListData['sectioncontent'] . "</p>";

                        echo "</div>";
                        break;
                }
            }
        }


    endforeach;
} else {

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

    foreach ($allblogs as $pos) :


        $currentPostion = $pos['placement'];
        $current_post_id = $pos['post_id'];


        if ($currentPostion == "") {

            $sql = "SELECT * FROM introduction WHERE post_id=$current_post_id";
            $introductionresult = mysqli_query($conn, $sql);

            $FirstintroductionData = mysqli_fetch_assoc($introductionresult);



            echo  " <div class='blog-list-container'>";
            echo "  <h2>" . $FirstintroductionData['title'] . "</h2>";
            echo " <div class='blog-list-image-container-categories'>";
            echo      "<img src=" . $FirstintroductionData['image_path'] . " class='image-blog-categories' />";
            echo " </div>";
            echo "<p>" . $FirstintroductionData['body'] . "</p>";

            echo " </div>";
        } else {
            $split_postions = explode(',', $currentPostion);



            foreach ($split_postions as $pos) {


                switch ($categories[$pos]) {
                    case 'Introduction':

                        $stmt = $conn->prepare("SELECT * FROM introduction WHERE post_id=?");
                        $stmt->bind_param("i", $current_post_id);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $introductionListData = $result->fetch_assoc();


                        echo  "<div class='blog-list-container'>";
                        echo "<h2>" . $introductionListData['title'] . "</h2>";
                        echo "<p>" . $formatted_date = date('F j, Y', strtotime($introductionListData['created_at']));
                        echo htmlspecialchars($formatted_date) . "</p>";

                        echo  "<div class='blog-list-image-container-categories'>";
                        echo '<img src="' . $introductionListData['image_path'] . '" class="image-blog-categories" />';

                        echo "</div>";
                        echo "<p>" . $introductionListData['body'] . "</p>";

                        echo "</div>";

                        break;
                    case 'Header':
                        $stmt = $conn->prepare("SELECT * FROM header WHERE post_id=?");
                        $stmt->bind_param("i", $current_post_id);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $headerListData = $result->fetch_assoc();;

                        echo "<div class='text-list-container'>";
                        echo "<h2 class='header-section'>" . $headerListData['header'] . "</h2>";
                        echo "</div>";

                        break;

                    case 'Paragraph':
                        $stmt = $conn->prepare("SELECT * FROM paragraph WHERE post_id=?");
                        $stmt->bind_param("i", $current_post_id);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $paragraphListData = $result->fetch_assoc();



                        echo "<div class='text-list-container'>";
                        echo "<p>" .  $paragraphListData['paragraph'] . "</p>";
                        echo "</div>";

                        break;

                    case 'Image':
                        $stmt = $conn->prepare("SELECT * FROM image WHERE post_id=?");
                        $stmt->bind_param("i", $current_post_id);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $imageListData = $result->fetch_assoc();


                        echo  "<div class='blog-list-image-section-container'>";
                        echo '<img src="' . $imageListData['image'] . '" class="image-blog-categories" />';

                        echo "</div>";
                        break;

                    case 'Section':
                        $stmt = $conn->prepare("SELECT * FROM section WHERE post_id=?");
                        $stmt->bind_param("i", $current_post_id);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $sectionListData = $result->fetch_assoc();

                        echo  "<div class='blog-list-container'>";
                        echo "<h2>" . $sectionListData['sectiontitle'] . "</h2>";
                        echo  "<div class='blog-list-image-container-categories'>";
                        echo '<img src="' . $sectionListData['sectionimage'] . '" class="image-blog-categories" />';

                        echo "</div>";
                        echo "<p>" . $sectionListData['sectioncontent'] . "</p>";

                        echo "</div>";
                        break;
                }
            }
        }


    endforeach;






}
