
<?php
include "db.php";

if(isset($_POST['login'])){

    $password = $_POST['password'];
    $email = $_POST['email'];

   // Search for user by email
    $result = $conn->query("SELECT * FROM users WHERE email='$email'");

    if($row = $result->fetch_assoc()){

        // Verify hashed password
        if(password_verify($password, $row['password'])){

           // Login
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['role'] = $row['role'];
           // Redirect to the home page
            header("Location: index.php");
            exit();

        } else {
            echo "❌ Incorrect password";
        }

    } else {
        echo"❌ This email does not exist";
    }
}
?>

<!-- Login Interface -->
<form method="POST">
    <h2>Login</h2>

    <input type="email" name="email" placeholder="Email" required><br><br>

    <input type="password" name="password" placeholder="Password" required><br><br>

    <button type="submit" name="login">Login</button>
</form>