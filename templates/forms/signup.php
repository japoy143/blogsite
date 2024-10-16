<?php

// database connection
include('../../config/db_conn.php');

//initial state
$email = $password = $confirmpassword = '';

//errors
$errors = [
    "email" => "",
    "password" => "",
    "confirm password" => "",
];


// if tapped submit
if (isset($_POST['submit'])) {

    $email = $_POST['email'];
    //email validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'email must be valid';
    }

    //password length must be atleast 8 characters
    if (strlen($_POST['password']) < 8) {
        $errors['password']  = "password must be atleast 8 characters";
    }

    // password  must be thesame
    if ($_POST['password'] != $_POST['confirmpassword']) {
        $errors['confirm password'] = "password must be thesame";
    }

    $sql = "SELECT * FROM users WHERE email = '$email'";
    //get the query result
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        echo 'data not found' . mysqli_error($conn);
    }

    $data = mysqli_fetch_assoc($result);
    // Check if email already exists
    if ($data) {
        $errors['email'] = "email already used";
        echo "<script>
        window.alert('email already used');
        </script>";
    }


    //check if there is no error then this will take action
    // check if the array is empty
    if (!array_filter($errors)) {

        //protect from sql injection
        $email = mysqli_real_escape_string($conn, $_POST['email']);

        $password = mysqli_real_escape_string($conn, $_POST['password']);


        // create user
        // or insert user in the database
        $sql = "INSERT INTO users(email, password) VALUES ('$email', '$password')";

        // save and check 
        if (mysqli_query($conn, $sql)) {
            header('Location: ./login.php ');
            echo "<script>
            window.alert('successfully created account');
            </script>";
        } else {
            echo 'Query error:' . mysqli_error($conn);
        }
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
            <form class="form-container" action="signup.php" method="post">
                <img class="form-img" src="../../assets/imgs/blogs_logo.svg">
                <h1>Sign Up!</h1>
                <p>please enter your details</p>

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

                <label>Confirm Password</label>
                <div class="input-container"><input placeholder="enter confirm password" type="text" name="confirmpassword" id="confirm-password-input" required>
                    <img class="password-icon" src="../../assets/icons/visible.svg" id="confirm-password-button">
                </div>
                <!-- error handler -->
                <div class="error-handler"><?php echo $errors['confirm password'] ?></div>

                <input type="submit" value="Sign Up" name="submit">

                <a id="alreadyhave_account" href="./login.php">already have account?</a>
            </form>
        </section>
        <section class="form-img-container"></section>
    </div>

</body>

<script src="../../scripts/forms.js"></script>

</html>