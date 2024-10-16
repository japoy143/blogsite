<?php

$conn = mysqli_connect('localhost', 'james', 'bagguard21', 'blogsite');

//check database connection
if (!$conn) {
    echo 'error database connection' . mysqli_connect_error();
}
