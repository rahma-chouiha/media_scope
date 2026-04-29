<?php
session_start();
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {

        // 🔥 نحفظ كل المعلومات المهمة
       $_SESSION['user'] = $user['id'];
       $_SESSION['name'] = $user['name'];
       $_SESSION['role'] = $user['role']; 
        header("Location: home.php");
        exit();

    } else {
        header("Location: loginRegister.html");
        exit();
    }
}
?>