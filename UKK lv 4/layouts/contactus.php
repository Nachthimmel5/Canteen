<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        
    body {
        margin: 0;
        padding: 0;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #f2f2f2; /* opsional */
        font-family: Arial, sans-serif;
    }
    .contact-form {
        background: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        display: flex;
        flex-direction: column;
        gap: 15px;
        width: 100%;
        max-width: 400px;
    }
    .contact-form input,
    .contact-form textarea {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 1rem;
    }
    .contact-form button {
        padding: 10px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 1rem;
    }
    .contact-form button:hover {
        background-color: #0056b3;
    }
    button {
    padding: 10px 20px;
    margin-top: 10px;
    background-color: #4CAF50; /* warna hijau */
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    }
    
    button:hover {
        background-color: #45a049;
    }
    
    /* Jika ingin khusus untuk tombol 'Kembali', beri class */
    .kembali-button {
        background-color: #f44336; /* warna merah */
        margin-left: 10px;
    }
    
    .kembali-button:hover {
        background-color: #d32f2f;
    }
    
    </style>
</head>
<body>

    <form class="contact-form">
        <h2>Contact Us</h2>
        <input type="text" name="nama" placeholder="Nama" required>
        <input type="email" name="email" placeholder="Email" required>
        <textarea name="pesan" rows="5" placeholder="Tulis pesan Anda..." required></textarea>
        <button type="submit">Kirim</button>
        <button type="button" onclick="history.back()">Kembali</button>
    </form>

</body>
</html>