<?php

session_start();



if($_SERVER['REQUEST_METHOD']= 'POST'){

    if(isset($_COOKIE['username'])){
        setcookie("username","",time()-3600,"/");
        session_unset();
        session_destroy();
    } 
    header("Location: index.php?page=user&action=login");
}
?>



<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
    <style>
        /* Thiết lập chung */
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
        }

        /* Nút logout */
        .logout-button {
            padding: 3px 5px;
            font-size: 14px;
            color: #fff;
            background-color: #ff4b5c;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .logout-button:hover {
            background-color: #d93745;
        }
    </style>
</head>
<body>

<!-- Nút logout -->
<form action="" method="POST">
    <button type="submit" class="logout-button">Logout</button>
</form>

</body>
</html>
