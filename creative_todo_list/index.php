<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>To-Do List</h1>

        <form action="add_task.php" method="post">
            <input type="text" name="title" placeholder="Judul kegiatan" required>
            <input type="datetime-local" name="deadline" required>
            <button type="submit">Tambah Kegiatan</button>
        </form>

        <div class="tasks">
            <?php
            $conn = new mysqli("localhost", "root", "", "todo_list_db");

            if ($conn->connect_error) {
                die("Koneksi gagal: " . $conn->connect_error);
            }

            $query = "SELECT * FROM tasks";
            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='task'>
                        <strong>Judul:</strong> " . htmlspecialchars($row['title']) . "<br>
                        <strong>Deadline:</strong> " . htmlspecialchars($row['deadline']) . "<br>
                        <strong>Status:</strong> 
                        <span class='" . strtolower(htmlspecialchars($row['status'])) . "'>" . htmlspecialchars($row['status']) . "</span>
                        <div class='task-actions'>
                            <form action='delete_task.php' method='post'>
                                <input type='hidden' name='id' value='" . $row['id'] . "'>
                                <button type='submit' class='delete-btn'>Hapus</button>
                            </form>
                            <form action='complete_task.php' method='post'>
                                <input type='hidden' name='id' value='" . $row['id'] . "'>
                                <button type='submit' class='complete-btn'>Selesai</button>
                            </form>
                        </div>
                    </div>";
                }
            } else {
                echo "<p>Tidak ada kegiatan.</p>";
            }

            $conn->close();
            ?>
        </div>
    </div>
</body>
</html>
