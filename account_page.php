<?php

//db 
include('./config/db_conn.php');

$initial_user_profile = './assets/icons/account.svg';


//check if tapped
if (isset($_POST['submit'])) {

    $filename = $_FILES['useraccount']['name'];
    $temp_name = $_FILES['useraccount']['tmp_name'];
    $folder = "./blogs_images/user_images/" . $filename;


    //get type 
    $file_types = ['png', 'jpeg', 'jpg'];
    $file_data = $_FILES['useraccount']['type'];
    $split_data = explode('/', $file_data);
    $file_type = $split_data[1];

    //get file size
    $file_size = $_FILES['useraccount']['size'];

    if (!in_array($file_type, $file_types) || $file_size > 150000) {
        $initial_user_profile = './assets/icons/account.svg';
    } else {
        move_uploaded_file($temp_name, $folder);
        $initial_user_profile = $folder;

        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recently</title>
    <link rel="stylesheet" href="styles/account.css">
</head>

<body>

    <h2>Account Settings</h2>

    <main>
        <h3>My Profile</h3>

        <form class="profile_container" method="post" enctype="multipart/form-data">
            <div>
                <div class="account-avatar">
                    <img src="<?php echo $initial_user_profile ?>" class="user_account">

                </div>
                <label for="upload-file" class="upload-button">
                    change profile
                    <img src="./assets/icons/upload.svg" class="upload-icon">
                </label>
                <input id="upload-file" type="file" name="useraccount">

            </div>
            <div class="account-info">
                <div class="information-container">
                    <h4>Name</h4>
                    <p>password</p>
                    <p>active</p>
                </div>
                <div class="update-account">
                    <a href="./home.php">home</a>
                    <input type="submit" name="submit" value='save'>
                </div>
            </div>


        </form>



    </main>


</body>

</html>