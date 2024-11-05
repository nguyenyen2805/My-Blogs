<?php
session_start();
if (isset($_SESSION['error_message'])) {
    echo "<script>alert('" . $_SESSION['error_message'] . "');</script>";
    unset($_SESSION['error_message']);
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách bài viết</title>
    <style>
        .post {
            border: 1px solid #ddd;
            padding: 10px;
            margin: 10px 0;
            max-width: 600px;
        }
        .post h2 {
            margin: 0;
        }
        .post p {
            margin: 5px 0;
        }
        .post span {
            font-size: 0.9em;
            color: gray;
        }
        .post-buttons {
            margin-top: 10px;
        }
        .post-buttons a {
            margin-right: 10px;
            padding: 5px 10px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 3px;
        }
        .post-buttons a.delete {
            background-color: red;
        }
    </style>
</head>
<body>

<h1>Danh sách bài viết</h1>

<?php

$sql = "SELECT blog_id, title, content, blogs.user_id, users.username
        FROM blogs
        JOIN users ON blogs.user_id = users.user_id;";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='post'>";
        echo "<h2>" . htmlspecialchars($row["title"]) . "</h2>";
        echo "<p><strong>Nội dung:</strong> " . nl2br(htmlspecialchars($row["content"])) . "</p>";
        echo "<span>Tác giả: " . htmlspecialchars($row["username"]) . "</span>";

       
        echo "<div class='post-buttons'>";
        echo "<a href='index.php?page=blog&action=update&blog_id=" . $row["blog_id"] . "'>Cập Nhật</a>";
        echo "<a href='index.php?page=blog&action=delete&blog_id=" . $row["blog_id"] . "' class='delete' onclick='return confirm(\"Bạn có chắc chắn muốn xóa bài viết này không?\");'>Xóa</a>";

        echo "</div>";
        
        echo "</div>";
    }
} else {
    echo "<p>Không có bài viết nào.</p>";
}

$conn->close();
?>

</body>
</html>
