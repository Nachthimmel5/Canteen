CREATE DATABASE kantin;
USE kantin;

CREATE TABLE canteens (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL
);

INSERT INTO canteens (name) VALUES 
('Kantin Ibu Rika'), 
('Kantin Mas Riki'),
('Kantin Bu Eka');

CREATE TABLE menu_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    canteen_id INT,
    name VARCHAR(100),
    price DECIMAL(10,2),
    stock INT,
    image VARCHAR(255),
    FOREIGN KEY (canteen_id) REFERENCES canteens(id)
);

INSERT INTO menu_items (canteen_id, name, price, stock, image) VALUES
(1, 'Nasi Gudeg', 20000, 15, 'nasigudeg.jpg'),
(1, 'Ayam Bakar Madu', 15000, 20, 'ayambakar.jpeg'),
(1,"Soto Lamongan", 15000, 10, 'sotolamongan.jpeg'),
(1,"Nasi pecel", 10000, 10, 'nasipecel.jpeg'),
(2,"Batagor", 5000, 50, 'batagor.jpg'),
(2,"Siomay", 5000, 50, 'siomay.jpg'),
(2,"Cilok", 5000, 20, 'cilok.jpeg'),
(2,"Cuanki", 5000, 10, 'cuanki.jpeg'),
(3,"Nasi Goreng", 20000, 10, 'nasigoreng.jpg'),
(3,"Ayam Pop", 15000, 10, 'ayampop.jpg')
;

CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    total_price DECIMAL(10,2),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT,
    menu_item_id INT,
    quantity INT,
    FOREIGN KEY (order_id) REFERENCES orders(id),
    FOREIGN KEY (menu_item_id) REFERENCES menu_items(id)
);
