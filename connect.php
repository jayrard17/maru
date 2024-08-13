<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customersFirstname = $_POST['customersFirstname'];
    $customersLastname = $_POST['customersLastname'];
    $customersAddress = $_POST['customersAddress'];
    $customersEmail = $_POST['customersEmail'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $conn = new mysqli('localhost', 'root', '', 'devilla_j');
    if ($conn->connect_error) {
        die('Connection Failed : '.$conn->connect_error);
    } else {
        $stmt = $conn->prepare("INSERT INTO registration (customersFirstname, customersLastname, customersAddress, customersEmail, username, password) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $customersFirstname, $customersLastname, $customersAddress, $customersEmail, $username, $password);

        if ($stmt->execute()) {
            $stmt->close();
            $conn->close();
            header("Location: login.php"); // Redirect to login.php
            exit();
        } else {
            echo "Error in registration: " . $stmt->error;
        }
    }
}
?>
