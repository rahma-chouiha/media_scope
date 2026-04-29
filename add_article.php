
<?php
session_start();
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
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
    <title>MediaScope | لوحة التحكم</title>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="اضافة خبر.css">
</head>
<body>
<div class="container">
    <h1>⚙️ لوحة التحكم | MediaScope</h1>

    <h3>إضافة خبر جديد</h3>
    <form method="POST" action="add_article.php">
    <input type="text" id="title" placeholder="عنوان الخبر (مثلاً: ورشة عمل جديدة)">
    <textarea id="content" rows="4" placeholder="اكتب تفاصيل الخبر هنا..."></textarea>
    <input type="text" id="image" placeholder="رابط صورة الخبر (URL)">

    <button class="btn-add" onclick="addArticle()">نشر الخبر الآن</button>
    <button class="btn-add" style="background: var(--text-muted); margin-top: 10px; cursor: pointer;" onclick="restoreLastPoint()">↩️ تراجع (استعادة نقطة حفظ سابقة)</button>
</form>
    <hr>

    <h3>إدارة الأخبار المنشورة</h3>
    <div id="articlesList">
        </div>
</div>
<a href="home.php" style="text-decoration: none; color: var(--primary-color); font-weight: bold;">
    ← العودة للرئيسية
</a>

<script src="اضافة خبر.js"></script>
</body>
</html>



