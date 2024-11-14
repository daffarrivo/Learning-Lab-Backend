<?php
$conn = new mysqli("localhost", "root", "", "todo_list_db");

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$title = $_POST['title'];
$description = $_POST['description'];
$deadline = $_POST['deadline'];

$current_time = date('Y-m-d H:i:s'); 
$status = (strtotime($deadline) < strtotime($current_time)) ? 'Past' : 'Ongoing';

$query = "INSERT INTO tasks (title, description, deadline, status) VALUES ('$title', '$description', '$deadline', '$status')";

if ($conn->query($query) === TRUE) {
    echo "Kegiatan berhasil ditambahkan!";
} else {
    echo "Error: " . $query . "<br>" . $conn->error;
}

$conn->close();
header("Location: index.php");
?>
