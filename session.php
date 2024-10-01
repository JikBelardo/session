<?php
session_start();

if (isset($_POST['BtnReset'])) {
    session_unset();
    session_destroy();
    header("Location: " . htmlspecialchars($_SERVER["PHP_SELF"]));
    exit;
}

if (!isset($_SESSION['username'])) {
    $_SESSION['username'] = array();
    $_SESSION['password'] = array();
}

if (isset($_POST['BtnLogin'])) {
    $newUsername = $_POST['username'];
    $newPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $_SESSION['username'][] = $newUsername;
    $_SESSION['password'][] = $newPassword;
}

$username = $_SESSION['username'];
$password = $_SESSION['password'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Session Reset and Password Encryption Example</title>
</head>
<body>
    <center>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            Username: <input type="text" name="username" placeholder="Enter username" required><br><br>
            Password: <input type="password" name="password" placeholder="Enter Password" required><br><br>
            <input type="submit" value="Login" name="BtnLogin"><br><hr>
            <input type="submit" value="Reset" name="BtnReset"><br><hr>
        </form>

        <?php
        if (!empty($username) && !empty($password)) {
            $count = 0;
            foreach ($username as $key => $value) {
                $count++;
                print "<br>$count: $username[$key], <br>$password[$key]";
            }
        }
        ?>
    </center>
</body>
</html>
