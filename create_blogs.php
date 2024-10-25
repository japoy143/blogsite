<?php

//check if user login if not then redirect it in index.php
include("./config/protected_routes.php");

//db
include('./config/db_conn.php');

//types
include('./models/blogType.php');





if (isset($_POST['submit'])) {
    $positions =  $_COOKIE['blogposition'];
    $splittedData = explode(',', $positions);


    $categories = [
        '0' => 'Introduction',
        '1' => 'Header',
        '2' => 'Paragraph',
        '3' => 'Image',
        '4' => 'Section'
    ];




    $counter = [0, 0, 0, 0];

    $random_generated_Id = rand(1, 9999999);

    $sql = "INSERT INTO blog_position(post_id,placement) VALUES ($random_generated_Id,'$positions')";
    // save and check 
    if (mysqli_query($conn, $sql)) {
        // Redirect to prevent form resubmission on refresh
        header('Location: ' . $_SERVER['PHP_SELF']);
    } else {
        echo 'Query error:' . mysqli_error($conn);
    }
    setcookie('blogposition', '');
    foreach ($splittedData as $pos) {


        switch ($categories[$pos]) {
            case 'Introduction':
                $title = mysqli_real_escape_string($conn, $_POST['introtitle']);
                $category = mysqli_real_escape_string($conn, $_POST['introcategory']);
                $subtitle = mysqli_real_escape_string($conn, $_POST['introsubtitle']);
                $image_path = "";
                $body =  mysqli_real_escape_string($conn, $_POST['introcontent']);
                $post_id =
                    mysqli_real_escape_string($conn, $random_generated_Id);



                //file image 
                $file_name = $_FILES['introimg']['name'];
                $tmp_name = $_FILES['introimg']['tmp_name'];
                $folder = "blogs_images/introduction_images/" . $file_name;

                //get type
                $file_type = $_FILES['introimg']['type'];
                $get_type = explode('/', $file_type);
                $img_type = $get_type[1];
                $types = ["jpg", "jpeg", "png"];


                //get size
                $file_size =
                    $_FILES['introimg']['size'];
                $broken_image_path = "blogs_images/broken.png";

                if (!in_array($img_type, $types) || $file_size > 150000) {
                    $image_path = $broken_image_path;
                } else {
                    if (move_uploaded_file($tmp_name, $folder)) {
                        $image_path = $folder;
                    } else {
                        $broken_image_path = "blogs_images/broken.png";
                    }
                }

                $final_image_path = mysqli_real_escape_string($conn, $image_path);



                $sql = "INSERT INTO introduction(title,category,image_path,body,post_id, subtitle) VALUES ('$title','$category','$final_image_path','$body',$post_id, '$subtitle')";


                // save and check 
                if (mysqli_query($conn, $sql)) {
                    // Redirect to prevent form resubmission on refresh
                    header('Location: ' . $_SERVER['PHP_SELF']);
                } else {
                    echo 'Query error:' . mysqli_error($conn);
                }
                break;
            case 'Header':
                $header = mysqli_real_escape_string($conn, $_POST['header' . $counter[0]]);

                $sql = "INSERT INTO header(header,post_id) VALUES ('$header',$post_id)";

                $counter[0]++;
                // save and check 
                if (mysqli_query($conn, $sql)) {
                    // Redirect to prevent form resubmission on refresh
                    header('Location: ' . $_SERVER['PHP_SELF']);
                } else {
                    echo 'Query error:' . mysqli_error($conn);
                }
                break;
            case 'Paragraph':
                $paragraph = mysqli_real_escape_string($conn, $_POST['paragraph' . $counter[1]]);

                $sql = "INSERT INTO paragraph(paragraph,post_id) VALUES ('$paragraph',$post_id)";

                $counter[1]++;
                // save and check 
                if (mysqli_query($conn, $sql)) {
                    // Redirect to prevent form resubmission on refresh
                    header('Location: ' . $_SERVER['PHP_SELF']);
                } else {
                    echo 'Query error:' . mysqli_error($conn);
                }
                break;
            case 'Image':
                $image_path = "";

                $file_name = $_FILES['image' . $counter[2]]['name'];
                $tmp_name =
                    $_FILES['image' . $counter[2]]['tmp_name'];

                $folder = 'blogs_images/images/' . $file_name;


                //get type
                $file_type
                    = $_FILES['image' . $counter[2]]['type'];
                $get_type = explode('/', $file_type);
                $img_type = $get_type[1];
                $types = ["jpg", "jpeg", "png"];

                //get  file size    
                $file_size =
                    $_FILES['image' . $counter[2]]['size'];
                $broken_image_path = "blogs_images/broken.png";

                if (!in_array($img_type, $types) || $file_size > 150000) {
                    $image_path = $broken_image_path;
                } else {
                    if (move_uploaded_file($tmp_name, $folder)) {
                        $image_path = $folder;
                    } else {
                        $broken_image_path = "blogs_images/broken.png";
                    }
                }

                $final_image_path = mysqli_real_escape_string($conn, $image_path);

                $sql = "INSERT INTO image(image,post_id) VALUES ('$final_image_path',$post_id)";

                $counter[2]++;
                // save and check 
                if (mysqli_query($conn, $sql)) {
                    // Redirect to prevent form resubmission on refresh
                    header('Location: ' . $_SERVER['PHP_SELF']);
                } else {
                    echo 'Query error:' . mysqli_error($conn);
                }
                break;
            case 'Section':
                $image_path = "";
                $sectionTitle = mysqli_real_escape_string($conn, $_POST['sectiontitle' . $counter[3]]);
                $sectionContent = mysqli_real_escape_string($conn, $_POST['sectioncontent' . $counter[3]]);




                $file_name = $_FILES['sectionimage' . $counter[3]]['name'];
                $tmp_name =
                    $_FILES['sectionimage' . $counter[3]]['tmp_name'];

                $folder = "blogs_images/section_images/" . $file_name;


                //get type
                $file_type
                    =
                    $_FILES['sectionimage' . $counter[3]]['type'];
                $get_type = explode('/', $file_type);
                $img_type = $get_type[1];
                $types = ["jpg", "jpeg", "png"];

                //get  file size
                $file_size =
                    $_FILES['sectionimage' . $counter[3]]['size'];
                $broken_image_path = "blogs_images/broken.png";


                if (!in_array($img_type, $types) || $file_size > 150000) {
                    $image_path = $broken_image_path;
                } else {
                    if (move_uploaded_file($tmp_name, $folder)) {
                        $image_path = $folder;
                    } else {
                        $broken_image_path = "blogs_images/broken.png";
                    }
                }

                $final_image_path = mysqli_real_escape_string($conn, $image_path);


                $sql = "INSERT INTO section(sectiontitle,sectionimage,sectioncontent,post_id) VALUES ('$sectionTitle', '$final_image_path', '$sectionContent', $post_id)";

                $counter[3]++;
                // save and check 
                if (mysqli_query($conn, $sql)) {
                    // Redirect to prevent form resubmission on refresh
                    header('Location: ' . $_SERVER['PHP_SELF']);
                } else {
                    echo 'Query error:' . mysqli_error($conn);
                }
                break;

            default:
                $title = mysqli_real_escape_string($conn, $_POST['introtitle']);
                $category = mysqli_real_escape_string($conn, $_POST['introcategory']);
                $subtitle = mysqli_real_escape_string($conn, $_POST['introsubtitle']);
                $image_path = "";
                $body =  mysqli_real_escape_string($conn, $_POST['introcontent']);
                $post_id =
                    mysqli_real_escape_string($conn, $random_generated_Id);



                //file image 
                $file_name = $_FILES['introimg']['name'];
                $tmp_name = $_FILES['introimg']['tmp_name'];
                $folder = "blogs_images/introduction_images/" . $file_name;

                //get type
                $file_type = $_FILES['introimg']['type'];
                $get_type = explode('/', $file_type);
                $img_type = $get_type[1];
                $types = ["jpg", "jpeg", "png"];


                //get size
                $file_size =
                    $_FILES['introimg']['size'];
                $broken_image_path = "blogs_images/broken.png";

                if (!in_array($img_type, $types) || $file_size > 150000) {
                    $image_path = $broken_image_path;
                } else {
                    if (move_uploaded_file($tmp_name, $folder)) {
                        $image_path = $folder;
                    } else {
                        $broken_image_path = "blogs_images/broken.png";
                    }
                }

                $final_image_path = mysqli_real_escape_string($conn, $image_path);



                $sql = "INSERT INTO introduction(title,category,image_path,body,post_id, subtitle) VALUES ('$title','$category','$final_image_path','$body',$post_id, '$subtitle')";


                // save and check 
                if (mysqli_query($conn, $sql)) {
                    // Redirect to prevent form resubmission on refresh
                    header('Location: ' . $_SERVER['PHP_SELF']);
                } else {
                    echo 'Query error:' . mysqli_error($conn);
                }
                exit();
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<!-- header -->
<?php include("./templates/header.php") ?>

<main class="Create Blogs" id="create_blogs">
    <form class="create-blogs-section" id="create-blogs-section" method="post" enctype="multipart/form-data">

        <div class="save-blogs">
            <input class="blogs-button" type="submit" value="Cancel" name="cancel">
            <input class="blogs-button" id="save-button" type="submit" value="Save" name="submit">
        </div>
    </form>
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