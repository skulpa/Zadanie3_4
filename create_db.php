<?php
$servername = "localhost";
$username = "root";
$password = "";
// Utworz polaczenie z baza danych 
$conn = new mysqli($servername, $username, $password);
// Sprawdz polaczenie
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Utworz baze danych 
$sql = "CREATE DATABASE IF NOT EXISTS Crawler";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . $conn->error;
}
$conn->select_db("Crawler");
// Stworz tabele z odwiedzonymi stronami
$sql = "CREATE TABLE IF NOT EXISTS SITES_VIEWED (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    site TEXT,
    date TIMESTAMP
)";
if (mysqli_query($conn, $sql)) {
    echo "Table SITES_VIEWED created successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}
// Stworz tabele z nieodwiedzonymi stronami
$sql = "CREATE TABLE IF NOT EXISTS SITES_TO_VIEW (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    site VARCHAR(200),
    date TIMESTAMP
)";
if (mysqli_query($conn, $sql)) {
    echo "Table SITES_TO_VIEW created successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}
$result = mysqli_query($conn, "SHOW COLUMNS FROM `SITES_VIEWED` LIKE 'content'");
$exists = (mysqli_num_rows($result)) ? TRUE:FALSE;
if (!$exists) {
    // sql to ALTER table
    $sql = "ALTER TABLE SITES_VIEWED ADD content TEXT after site";
    if (mysqli_query($conn, $sql)) {
        echo "ALTER TABLE SITES_VIEWED successfully";
    } else {
        echo "Error creating table: " . mysqli_error($conn);
    }
    
    // Zmienia wlasciwosci utworzonej tabeli 
    $sql = "ALTER TABLE SITES_VIEWED MODIFY site VARCHAR(2048)";
    if (mysqli_query($conn, $sql)) {
        echo "ALTER TABLE SITES_VIEWED successfully";
    } else {
        echo "Error creating table: " . mysqli_error($conn);
    }
}
$conn->close();
?>
