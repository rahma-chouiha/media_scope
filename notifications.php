
<?php
include "db.php";

$user_id = $_SESSION['user_id'];

$result = $conn->query("SELECT * FROM notifications 
WHERE user_id=$user_id ORDER BY created_at DESC");

while($row = $result->fetch_assoc()){
    echo "<p>".$row['title']." - ".$row['message']."</p>";
}
?>