<?php

$inventoryProduct = $_POST['inventoryProduct'];
$customersFirstname = $_POST['customersFirstname'];
$customersLastname = $_POST['customersLastname'];
$ordersTotal = $_POST['ordersTotal'];

$conn = new mysqli('localhost', 'root', '', 'devilla_j');
if ($conn->connect_error) {
    die('Connection Failed : '.$conn->connect_error);
} else {
    $stmt = $conn->prepare("INSERT INTO orders (ordersID, inventoryProduct, customersFirstname, customersLastname, ordersTotal) VALUES (?, ?, ?, ?, ?)");

    $stmt->bind_param("issss", $ordersID, $inventoryProduct, $customersFirstname, $customersLastname, $ordersTotal);

    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        echo '<script>alert("Order Successful! Thank you!"); window.location.href = "shop.html";</script>';
        exit();
    } else {
        echo "Error in Order: " . $stmt->error;
    }
}
?>
