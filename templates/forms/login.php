<?php

//db
include('../../config/db_conn.php');

// Start the session
session_start();

//initial state
$email = $password = "";

$errors = [
    "email" => "",
    "password" => "",
];

if (isset($_POST['submit'])) {

    if (strlen($_POST["password"] < 8)) {
        $errors["password"] = "password must be atleast 8 characters";
    }


    $email = mysqli_escape_string($conn, $_POST["email"]);
    $password = mysqli_escape_string($conn, $_POST["password"]);


    //prepared statement
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $data  = $result->fetch_assoc();


    if (!$result) {
        echo "query error:" . mysqli_error($conn, $sql);
    }



    if (!$data) {
        echo "<script>
            window.alert('email not found');
            </script>";
    }

    $hashedPassword = $data["password"];
    //decrypt
    //check if password thesame 
    if (!password_verify($password, $hashedPassword)) {
        $errors['password'] = "password incorrect try again";
    }

    if (!array_filter($errors)) {
        $_SESSION["user"] = $data["email"];
        $_SESSION["isLogin"] = true;
        header("Location:../../home.php");
    }
}



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recently</title>
    <link rel="stylesheet" href="../../styles/forms.css">
</head>

<body>

    <div class="form-division">
        <section class="form-wrapper">
            <form class="form-container" method="post" action="login.php">
                <img class="form-img" src="../../assets/imgs/blogs_logo.svg">
                <h1>Welcome Back!</h1>
                <p>Glad to see you again</p>
                <p>Login to your account below</p>

                <label>Email</label>
                <div class="input-container"><input placeholder="youre@email.com" type="email" name="email" required></div>
                <!-- error handler -->
                <div class="error-handler"><?php echo $errors['email'] ?></div>

                <label>Password</label>
                <div class="input-container"><input placeholder="enter password" type="text" name="password" id="password-input" required>
                    <img class="password-icon" src="../../assets/icons/visible.svg" id="password-button">
                </div>
                <!-- error handler -->
                <div class="error-handler"><?php echo $errors['password'] ?></div>


                <input type="submit" value="Login" name="submit">

                <div class="forms-choices">
                    <a id="alreadyhave_account" href="./signup.php">doesnt have account?</a>
                    <a id="alreadyhave_account" href="../../index.php">back</a>
                </div>

            </form>
        </section>
        <section class="form-img-container"></section>
    </div>

</body>

<script src="../../scripts/forms.js"></script>

</html>