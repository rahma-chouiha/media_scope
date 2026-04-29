<?php
session_start();
include "db.php";

$id = $_SESSION['user_id'];

if(isset($_POST['update'])){
    $name = $_POST['name'];
    $email = $_POST['email'];

    // الصورة
    $image = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];

    if($image){
        move_uploaded_file($tmp, "uploads/".$image);
        $sql = "UPDATE users SET name=?, email=?, image=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $name, $email, $image, $id);
    } else {
        $sql = "UPDATE users SET name=?, email=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $name, $email, $id);
    }

    $stmt->execute();
    header("Location: profile.php");
}
?>

<form method="POST" enctype="multipart/form-data">
    <input type="text" name="name" placeholder="الاسم"><br><br>
    <input type="email" name="email" placeholder="الإيميل"><br><br>
    <input type="file" name="image"><br><br>
    <button name="update">تحديث</button>
</form>