<?php 
session_start();



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $conn->real_escape_string($_POST['title']);
    $content = $conn->real_escape_string($_POST['content']);
    $user_id = $_SESSION['user_id'] ?? null; 
    
    if (empty($user_id)) {
     
        header('Location: index.php?page=user&action=login');
        exit;
    } else {
        if (!empty($title) && !empty($content)) {
            
            $string = "INSERT INTO blogs (title, content, user_id) VALUES ('$title', '$content', $user_id)";
            $create = $conn->query($string);

            if ($create) {
                echo "Tạo thành công!";
            } else {
                echo "Lỗi: " . $conn->error;
            }
        } else {
            echo "Tiêu đề hoặc nội dung bị thiếu.";
        }
    }
}
?>

<form method="post" enctype="multipart/form-data" style="display: flex; flex-direction: column; max-width: 400px; margin: auto;">
    <label>Tiêu đề:</label>
    <input type="text" name="title" placeholder="Tiêu đề" required style="padding: 8px; margin-bottom: 10px;">

    <label>Nội dung:</label>
    <textarea name="content" placeholder="Nội dung" required style="padding: 8px; margin-bottom: 10px; height: 100px;"></textarea>

    <label for="avatar">Chọn ảnh đại diện:</label>
    <input type="file" name="avatar" accept="image/*" style="margin-bottom: 10px;">

    <button type="submit" style="padding: 10px; background-color: #007bff; color: white; font-weight: bold; border: none; cursor: pointer;">
        Thêm bài viết
    </button>
</form>
