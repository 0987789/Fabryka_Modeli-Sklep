<?php
$connection = include('connect_script.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = mysqli_real_escape_string($connection, $_POST['login']);
    $password = $_POST['password'];
    $name = mysqli_real_escape_string($connection, $_POST['name']);
    $surname = mysqli_real_escape_string($connection, $_POST['surname']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    $check_login = "SELECT * FROM users WHERE login = '$login'";
    $result_login = $connection->query($check_login);
    
    if ($result_login->num_rows > 0) {
        header("Location: ../register.php?error=login_exists");
        exit();
    }
    
    $check_email = "SELECT * FROM users WHERE e_mail = '$email'";
    $result_email = $connection->query($check_email);
    
    if ($result_email->num_rows > 0) {
        header("Location: ../register.php?error=email_exists");
        exit();
    }
    
    $sql = "INSERT INTO users (login, password, name, surname, e_mail) VALUES ('$login', '$hashed_password', '$name', '$surname', '$email')";
    
    if ($connection->query($sql) === TRUE) {
        header("Location: ../login.php?registered=success");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $connection->error;
    }
}

$connection->close();
?>