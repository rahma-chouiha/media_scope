
<?php
include "db.php";

// Secrety
if($_SESSION['role'] != 'admin'){
    die("NO! error");
}

if(isset($_POST['add'])){

    $title = $_POST['title'];
    $content = $_POST['content'];
    $user_id = $_SESSION['user_id'];

    // add articl
    $conn->query("INSERT INTO articles (title, content, user_id)
    VALUES ('$title','$content','$user_id')");

    // send mesg
    $users = $conn->query("SELECT id FROM users WHERE notifications_enabled=1");

    while($u = $users->fetch_assoc()){
        $uid = $u['id'];

        $conn->query("INSERT INTO notifications (title,message,user_id)
        VALUES ('New News','تم نشر: $title',$uid)");
    }

    echo "تم النشر + إرسال إشعارات";
}
?>

<form method="POST">
<input type="text" name="title" placeholder="title"><br>
<textarea name="content"></textarea><br>
<button name="add">نشر</button>
</form>