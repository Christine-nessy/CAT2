
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registration";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

if ($password === $confirm_password) {
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (first_name, last_name, email, username, password) VALUES (?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $first_name, $last_name, $email, $username, $hashed_password);

    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        header("Location: LOGIN.html");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        $stmt->close();
        $conn->close();
    }
} else {
    echo "Passwords do not match.";
}

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>| SignUpForm|</title>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="signup-box">
<h1>SignUp</h1>
<h4>Its Free and only takes a minute</h4>

<form action="signup.php"method="POST">
<label>First Name </label>
<input type="text" name="first_name" placeholder="">
<label>Last Name </label>
<input type="text" name="last_name" placeholder="">
<label>Email </label>
<input type="email" name="email" placeholder="">
<label>Username</label>
<input type="text" name="username" placeholder="">
<label>Password </label>
<input type="password" name="password" placeholder="">
<label>Confirm Password </label>
<input type="password" name="confirm_password" placeholder="">
<input type="submit" name="submit" value="submit">
</form>
<p>By clicking the SignUp button, you agree to our<br><a href="#">Terms and conditions</a> and <a href="#"></a> Policy Privacy.
</p>
</div>
<p class="para-2">Already have an account? <a href="LOGIN.html">Login here</a></p>


</body>
</html>