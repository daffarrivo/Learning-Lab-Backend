<?php
$conn = new mysqli("localhost", "root", "", "todo_list_db");

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$id = $_POST['id'];

$query = "DELETE FROM tasks WHERE id = $id";

if ($conn->query($query) === TRUE) {
    header("Location: index.php");
} else {
    echo "Error: " . $query . "<br>" . $conn->error;
}

$conn->close();
?>
