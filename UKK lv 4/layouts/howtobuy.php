<?php
include '../service/database.php';
$items = $conn->query("SELECT * FROM menu_items");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pilih Menu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        h2 {
            margin-bottom: 20px;
        }

        .menu-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .menu-card {
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 10px;
            width: 200px;
            text-align: center;
            background-color: #f9f9f9;
            box-shadow: 2px 2px 5px rgba(0,0,0,0.1);
        }

        .menu-card.out-of-stock {
            opacity: 0.5;
        }

        .menu-card img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .stock-warning {
            color: red;
            font-weight: bold;
        }

        .quantity-input {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            margin-top: 5px;
        }

        .quantity-input button {
            width: 30px;
            height: 30px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            background-color: #ccc;
            border: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .quantity-input button:hover {
            background-color: #bbb;
        }

        .qty-input {
            width: 40px;
            text-align: center;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #fff;
        }

        .form-buttons {
            margin-top: 20px;
            display: flex;
            gap: 15px;
        }

        .form-buttons button,
        .form-buttons a {
            padding: 10px 30px;
            font-size: 16px;
            font-weight: bold;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transition: background-color 0.3s, transform 0.2s;
            text-decoration: none;
            text-align: center;
            display: inline-block;
        }

        button[type="submit"] {
            background-color: #28a745;
            color: white;
        }

        button[type="submit"]:hover {
            background-color: #218838;
            transform: scale(1.03);
        }

        a.back-button {
            background-color: #007bff;
            color: white;
        }

        a.back-button:hover {
            background-color: #0056b3;
            transform: scale(1.03);
        }
    </style>
</head>
<body>

<h2>Pilih Makanan</h2>
<form action="../buy.php" method="POST">
    <div class="menu-container">
        <?php while($row = $items->fetch_assoc()): ?>
            <div class="menu-card <?= $row['stock'] == 0 ? 'out-of-stock' : '' ?>">
                <img src="../assets/image/<?= $row['image'] ?>" alt="<?= $row['name'] ?>">
                <h4><?= $row['name'] ?></h4>
                <p>Rp<?= number_format($row['price']) ?></p>
                <p>Stok: <?= $row['stock'] ?></p>

                <?php if ($row['stock'] == 0): ?>
                    <p class="stock-warning">Maaf stok telah habis</p>
                <?php else: ?>
                    <div class="quantity-input">
                        <button type="button" class="minus-btn" data-id="<?= $row['id'] ?>">−</button>
                        <input type="text" name="qty[<?= $row['id'] ?>]" class="qty-input" id="qty-<?= $row['id'] ?>" value="0" readonly>
                        <button type="button" class="plus-btn" data-id="<?= $row['id'] ?>">+</button>
                    </div>
                    <input type="hidden" id="max-<?= $row['id'] ?>" value="<?= $row['stock'] ?>">
                <?php endif; ?>
            </div>
        <?php endwhile; ?>
    </div>

    <div class="form-buttons">
        <button type="submit">🛒 Checkout</button>
        <a href="../index.php" class="back-button">← Kembali ke Home</a>
    </div>
</form>

<script>
    document.querySelectorAll(".minus-btn").forEach(btn => {
        btn.addEventListener("click", () => {
            const id = btn.dataset.id;
            const input = document.getElementById("qty-" + id);
            let value = parseInt(input.value) || 0;
            if (value > 0) input.value = value - 1;
        });
    });

    document.querySelectorAll(".plus-btn").forEach(btn => {
        btn.addEventListener("click", () => {
            const id = btn.dataset.id;
            const input = document.getElementById("qty-" + id);
            const max = parseInt(document.getElementById("max-" + id).value);
            let value = parseInt(input.value) || 0;
            if (value < max) input.value = value + 1;
        });
    });

    // Validasi saat submit form
    document.querySelector("form").addEventListener("submit", function (e) {
        let totalQty = 0;
        document.querySelectorAll(".qty-input").forEach(input => {
            totalQty += parseInt(input.value) || 0;
        });

        if (totalQty === 0) {
            e.preventDefault(); // Mencegah form dikirim
            alert("Mohon pilih menu terlebih dahulu.");
        }
    });
</script>

</body>
</html>
