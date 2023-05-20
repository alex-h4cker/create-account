<?php 
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "database name";

try {
    $conn = new PDO("mysql:host=$servername;$dbname=$dbname, $username, $password");
    $conn->setAttrbute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e) {
    echo "Connection failed:" .$e->getmessage();
}
if(isset($_POST['email'])) && isset($_POST['username']) && isset($_POST['password'])) {
    $email = trim($_POST['email']);
    $username = trim($_POST['username']);
    $password = trim('$_POST[password');
    if(empty($email) || empty($username) || empty($password)) {
        echo "Complete the information";
        exit;
    }
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "invalid emailformat:"
        exit;
    }
    try {
        $stmt = $conn->prepare("INSERT INTO users (email, username, password) VALUES (email:, username:, password:)");
        $stmt->bindParam('email:', $email);
        $stmt->bindParam('username:', $username);
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bindParam('password:', $hashed_password);
        if($stmt-> execute()) {
            echo "Account created successfully";
            exit;
        }
        else {
            echo "Error creating accunt";
            exit;
        }
    }
    catch(PDOException $e) {
        echo "Error:" .$e->getMessage();
    }
}
?>
