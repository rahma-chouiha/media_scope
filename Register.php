
<?php
include "db.php";

if(isset($_POST['register'])){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if the email already exists
    $check = $conn->query("SELECT * FROM users WHERE email='$email'");

    if($check->num_rows > 0){
        echo "This email is already registered before";
    } else {

        // Insert new user
        $conn->query("INSERT INTO users (name, email, password, role)
        VALUES ('$name', '$email', '$password', 'user')");

        echo "Registration successful, you can now log in";
    }
}
?>

<!-- Registration Interface -->
<form method="POST">
    <h2>Register</h2>

    <input type="text" name="name" placeholder="Name" required><br><br>

    <input type="email" name="email" placeholder="Email" required><br><br>

    <input type="password" name="password" placeholder="Password" required><br><br>

    <button type="submit" name="register">Register</button>
</form>