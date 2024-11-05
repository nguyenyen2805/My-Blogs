<?php 
session_start();

$blog_id = $_GET['blog_id'] ?? null; 
$user_id = $_SESSION['user_id'] ?? null;

if (empty($blog_id) || empty($user_id) || empty($_COOKIE['username'])) {
    $_SESSION['error_message'] = "Không tìm thấy bài viết hoặc  chưa đăng nhập.";
    header('Location: index.php?page=blog&action=read');
    exit;
}

$sql = "SELECT * FROM blogs WHERE blog_id = $blog_id AND user_id = $user_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $sql = "DELETE FROM blogs WHERE blog_id = $blog_id AND user_id = $user_id";
    $delete = $conn->query($sql);

    if ($delete) {
        header('Location: index.php?page=blog&action=read'); 
        exit;
    } else {
        echo "Lỗi: " . $conn->error;
    }
} else {
    $_SESSION['error_message'] = "Bài viết không tồn tại hoặc  không có quyền xóa.";
    header('Location: index.php?page=blog&action=read');
    exit;
}



$conn->close();
?>
