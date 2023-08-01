<?php
session_start();

$email = $_POST['email'];
$password = $_POST['password'];

// Abrindo uma nova conexão com o Servidor do MySQL
$mysqli = new mysqli('localhost', 'root', '', 'perfectcup');


// Saída de qualquer erro de conexão
if ($mysqli->connect_error) {
    die('Error : (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

$query = "SELECT * FROM members WHERE email='$email'";
$result = mysqli_query($mysqli, $query) or die();
$num_row = mysqli_num_rows($result);
$row = mysqli_fetch_array($result);

if ($num_row >= 1) {

    if (password_verify($password, $row['password'])) {

        $_SESSION['login'] = $row['id'];
        $_SESSION['fname'] = $row['fname'];
        $_SESSION['lname'] = $row['lname'];
        echo 'true';
    }
    else {
        echo 'false';
    }

} else {
    echo 'false';
}
