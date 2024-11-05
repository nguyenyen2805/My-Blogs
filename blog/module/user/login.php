<?php
session_start();


if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
    $username = rm_charac($_POST['user']);
    $password = rm_charac($_POST['pass']);

    if ($username != "" && $password != "") {
        
        $checkexist = "SELECT user_id, username, password FROM users WHERE username='$username' AND password='$password'";
        $result = $conn->query($checkexist);

        if ($result && $result->num_rows == 1) {
            $user = $result->fetch_assoc();
            $_SESSION['user_id'] = $user['user_id']; // lưu user_id vào session
            $_SESSION['username'] = $username;

            
            $rememberMe = isset($_POST['remember']);
            if ($rememberMe) {
                setcookie("username", $username, time() + (86400 * 30), "/"); // Cookie lưu 30 ngày
            } else {
                if (isset($_COOKIE['username'])) {
                    setcookie("username", "", time() - 3600, "/"); // Xóa cookie
                }
            }

            header('Location: /practice_php/index.php');
            exit;
        } else {
            echo "Sai tài khoản hoặc mật khẩu.";
        }
    }
    $conn->close();
}
?>

<form action="/practice_php/index.php?page=user&action=login" method="POST">
    <label for="username">Username:</label><br>
    <input type="text" name="user" required><br><br>

    <label for="password">Password:</label><br>
    <input type="password" name="pass" required><br><br>

    <label>
        <input type="checkbox" name="remember"> Remember Me
    </label><br><br>

    <button type="submit">Login</button>
</form>

<p>
    Chưa có tài khoản? <a href="/practice_php/index.php?page=user&action=signup">Click here</a>
</p>
