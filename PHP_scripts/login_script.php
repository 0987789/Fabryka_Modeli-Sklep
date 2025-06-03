<?php
session_start();
$connection = include('connect_script.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = mysqli_real_escape_string($connection, $_POST['login']);
    $password = $_POST['password'];
    
    $sql = "SELECT * FROM users WHERE login = '$login'";
    $result = $connection->query($sql);
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['login'] = $user['login'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['surname'] = $user['surname'];
            
            header("Location: ../account.php");
            exit();
        } else {
            header("Location: ../login.php?error=invalid_password");
            exit();
        }
    } else {
        header("Location: ../login.php?error=invalid");
        exit();
    }
}

$connection->close();
?>