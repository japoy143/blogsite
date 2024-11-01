<?php

//db 
include('./config/db_conn.php');
session_start();


$user_id = $_SESSION['user_id'] ?? 0;

//get user data
$stmt = $conn->prepare("SELECT * FROM users WHERE id=?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user_data = $result->fetch_assoc();


$user_profile = $user_data['user_profile'] == null ||  $user_data['user_profile'] == ' ' ? "./assets/icons/account.svg" :  $user_data['user_profile'];





//check if tapped
if (isset($_POST['submit'])) {

    //if there is selected file
    if ($_FILES['useraccount']['name'] != null) {
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
        }
    }

    $password = $_POST['password'];
    $current_password = $_POST['currentpass'];

    //hash password
    $new_passoword = $_POST['newpassword'];
    $hashPassword = $current_password;

    if (password_verify($password, $current_password)) {

        $hashPassword = password_hash($new_passoword, PASSWORD_DEFAULT);
    }


    //user details
    $email = mysqli_real_escape_string($conn, $_POST['email']);


    //update user details
    $stmt = $conn->prepare("UPDATE users SET email = ?, password = ?, user_profile =?");
    $stmt->bind_param("sss", $email, $hashPassword, $initial_user_profile);

    if (!$stmt->execute()) {
        echo $stmt->error . "error";
    } else {
        mysqli_close($conn);
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

    <div class="heading">
        <h2>Account Settings</h2>
        <a href="home.php">Home</a>
    </div>

    <main>
        <h3>My Profile</h3>

        <form class="profile_container" method="post" enctype="multipart/form-data">
            <div class="user-image-profile">
                <div class="account-avatar" id="account-avatar">
                    <img id="dynamic-user-image" src="<?php echo htmlspecialchars($user_profile) ?>" class="user_account">

                </div>
                <label for="upload" class="upload-button">
                    change profile
                    <img src="./assets/icons/upload.svg" class="upload-icon">
                </label>
                <input id="upload" type="file" name="useraccount" accept=".jpg, .jpeg, .png">

            </div>
            <div class="account-info">
                <div class="information-container">
                    <label>Name</label>
                    <input type="text" name="email" placeholder="enter your name" value="<?php echo htmlspecialchars($user_data['email']) ?>">
                    <label>Password</label>
                    <input type="text" name="password" placeholder="enter password for validation">
                    <label>New password</label>
                    <input type="text" name="newpassword" placeholder="enter new password">
                    <input type="hidden" name="currentpass" value="<?php echo htmlspecialchars($user_data['password']) ?>">
                    <p>active</p>
                </div>
                <div class="update-account">

                    <input type="submit" name="submit" value='Update'>
                </div>
            </div>


        </form>



    </main>

    <!-- reference https://drive.google.com/drive/folders/1k_bQq_RlllBCL-4veMjWty9snEa9RPu8 -->
    <script type="text/javascript">
        document.getElementById("upload").onchange = function() {
            //get the image url
            document.getElementById("dynamic-user-image").src = URL.createObjectURL(upload.files[0]);

        }
    </script>

</body>

</html>