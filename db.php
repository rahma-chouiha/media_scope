
<?php
$conn = new mysqli("localhost", "root", "", "media_scope");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();
?>