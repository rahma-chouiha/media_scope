<?php
session_start();

// حذف كل بيانات الجلسة
session_unset();
session_destroy();

// توجيه لصفحة تسجيل الدخول
header("Location: loginRegister.html");
exit();
?>