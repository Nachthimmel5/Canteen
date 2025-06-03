<?php
include './service/database.php';

$qtys = isset($_POST['qty']) && is_array($_POST['qty']) ? $_POST['qty'] : [];
$total = 0;

$conn->query("INSERT INTO orders (total_price) VALUES (0)");
$order_id = $conn->insert_id;

if (!empty($qtys)) {
    foreach($qtys as $id => $qty){
        if($qty > 0){
            $item = $conn->query("SELECT * FROM menu_items WHERE id=$id")->fetch_assoc();
            $subtotal = $item['price'] * $qty;
            $total += $subtotal;

            $conn->query("INSERT INTO order_items (order_id, menu_item_id, quantity) 
                          VALUES ($order_id, $id, $qty)");

            $conn->query("UPDATE menu_items SET stock = stock - $qty WHERE id = $id");
        }
    }
}

$conn->query("UPDATE orders SET total_price = $total WHERE id = $order_id");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Total Pembayaran</title>
    <style>
        body {
            background: white;
            color: black;
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 50px;
        }
        h2 {
            font-size: 28px;
            margin-bottom: 20px;
        }
        p {
            font-size: 18px;
            margin: 10px 0;
        }
        img {
            margin-top: 20px;
        }
        .back-button {
            display: inline-block;
            margin-top: 30px;
            padding: 12px 25px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }
        .back-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <h2>Total Bayar: Rp<?= number_format($total) ?></h2>
    <img src="assets/image/logo.png" width="200" alt="Logo">
    <p>Scan QR untuk bayar</p>

    <!-- Tombol Kembali -->
    <a href="index.php" class="back-button">Kembali ke Halaman Utama</a>

</body>
</html>
