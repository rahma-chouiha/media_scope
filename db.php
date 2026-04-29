<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "media_scope";

// إنشاء الاتصال بقاعدة البيانات
$conn = new mysqli($host, $user, $password, $database);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>