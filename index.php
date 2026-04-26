
<?php
session_start();

if(isset($_SESSION['user_id'])){
    header("Location: dashboard.php");
    exit();
}
?>

<h1>🎬 Media Scope</h1>

<a href="login.php">🔐 Login</a> |
<a href="register.php">📝 Register</a>