<?php
session_start();
include "db.php";

if (isset($_POST['register'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // التحقق إذا الإيميل موجود
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {

        echo "<script>
            alert('Email already exists');
            window.location.href='loginRegister.html';
        </script>";

    } else {

        // إدخال المستخدم الجديد
        $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, 'user')");
        $stmt->bind_param("sss", $name, $email, $password);
        $stmt->execute();

        // 👇 ندخلوه مباشرة (Auto login)
        $_SESSION["user"] = $stmt->insert_id;
        $_SESSION["name"] = $name;
        $_SESSION["role"] = "user";

        // 👇 يروح مباشرة للرئيسية
        header("Location: home.php");
        exit();
    }
}
?>