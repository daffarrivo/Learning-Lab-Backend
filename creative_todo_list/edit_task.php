<?php
$conn = new mysqli("localhost", "root", "", "interactive_todo_list");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM tasks WHERE id=$id");
$task = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $deadline = $_POST['deadline'];
    $status = $_POST['status'];
    $conn->query("UPDATE tasks SET title='$title', description='$description', deadline='$deadline', status='$status' WHERE id=$id");
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Edit Tugas</title>
</head>
<body>
    <h1>Edit Tugas</h1>
    <form action="" method="post">
        <input type="text" name="title" value="<?php echo $task['title']; ?>" required>
        <textarea name="description"><?php echo $task['description']; ?></textarea>
        <input type="datetime-local" name="deadline" value="<?php echo date('Y-m-d\TH:i', strtotime($task['deadline'])); ?>" required>
        <select name="status">
            <option value="Ongoing" <?php echo $task['status'] == 'Ongoing' ? 'selected' : ''; ?>>Ongoing</option>
            <option value="Completed" <?php echo $task['status'] == 'Completed' ? 'selected' : ''; ?>>Completed</option>
            <option value="Past" <?php echo $task['status'] == 'Past' ? 'selected' : ''; ?>>Past</option>
        </select>
        <button type="submit">Simpan</button>
    </form>
</body>
</html>
