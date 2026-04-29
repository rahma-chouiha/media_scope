<?php
session_start();
include "db.php";

// حماية الصفحة
if(!isset($_SESSION['user_id'])){
    header("Location: loginRegister.php"); 
    exit();
}

$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
?>

<h1>👋 Welcome <?php echo $user['name']; ?></h1>

<?php if($user['role'] == 'admin'){ ?>

    <h2>🛠 Admin Dashboard</h2>

    <h3>📋 Users List:</h3>

    <?php
    $res = $conn->query("SELECT * FROM users");
    while($row = $res->fetch_assoc()){
        echo $row['name']." - ".$row['email']."<br>";
    }
    ?>

<?php } else { ?>

    <h2>👤 User Profile</h2>
    <p>Name: <?php echo $user['name']; ?></p>
    <p>Email: <?php echo $user['email']; ?></p>

    <a href="edit_profile.php">✏️ تعديل المعلومات</a>

<?php } ?>

<br><br>
<a href="logout.php">🚪 Logout</a>