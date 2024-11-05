<?php 
session_start();




$blog_id = intval($_GET['blog_id']) ?? null; 
$user_id = $_SESSION['user_id'] ?? null;

if (empty($blog_id) || empty($user_id) || empty($_COOKIE['username'])) {
    $_SESSION['error_message'] = "Không tìm thấy bài viết hoặc  chưa đăng nhập.";
    header('Location: index.php?page=blog&action=read');
    exit;
}


$sql = "SELECT * FROM blogs WHERE blog_id = $blog_id AND user_id = $user_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $blog = $result->fetch_assoc();
} else {
    echo "Bài viết không tồn tại hoặc  không có quyền chỉnh sửa.";
    exit;
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $conn->real_escape_string($_POST['title']);
    $content = $conn->real_escape_string($_POST['content']);

    if (!empty($title) && !empty($content)) {
        $sql = "UPDATE blogs SET title = '$title', content = '$content' WHERE blog_id = $blog_id AND user_id = $user_id";
        $update = $conn->query($sql);

        if ($update) {
            echo "Cập nhật thành công!";
            header('Location: index.php?page=blog&action=read');
            exit;
        } else {
            echo "Lỗi: " . $conn->error;
        }
    } else {
        echo "Tiêu đề hoặc nội dung bị thiếu.";
    }
}


?>

<h1>Cập Nhật Bài Viết</h1>
<form method="post" style="display: flex; flex-direction: column; max-width: 400px; margin: auto;">
    <label>Tiêu đề:</label>
    <input type="text" name="title" value="<?php echo htmlspecialchars($blog['title']); ?>" required style="padding: 8px; margin-bottom: 10px;">

    <label>Nội dung:</label>
    <textarea name="content" required style="padding: 8px; margin-bottom: 10px; height: 100px;"><?php echo htmlspecialchars($blog['content']); ?></textarea>

    <button type="submit" style="padding: 10px; background-color: #007bff; color: white; font-weight: bold; border: none; cursor: pointer;">
        Cập nhật bài viết
    </button>
</form>
