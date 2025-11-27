-- 1. CRIAÇÃO DO BANCO DE DADOS
DROP DATABASE IF EXISTS black_friday;
CREATE DATABASE black_friday;
USE black_friday;

-- 2. TABELA DE USUÁRIOS
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(150) NOT NULL,
    email VARCHAR(200) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL
);

-- 3. TABELA DE PRODUTOS
CREATE TABLE produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(200) NOT NULL,
    descricao TEXT,
    preco_normal DECIMAL(10,2), 
    preco_promo DECIMAL(10,2),  
    imagem VARCHAR(255),        
    categoria VARCHAR(100)     
);

-- 4. TABELA DE PEDIDOS 
CREATE TABLE pedidos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    data_pedido DATETIME DEFAULT CURRENT_TIMESTAMP,
    valor_total DECIMAL(10,2),
    
    -- Campos de Endereço
    cep VARCHAR(10),
    rua VARCHAR(150),
    numero VARCHAR(20),
    bairro VARCHAR(100),
    cidade VARCHAR(100),
    estado VARCHAR(2),
    
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id)
);

-- 5. TABELA DE ITENS DO PEDIDO
CREATE TABLE itens_pedido (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_pedido INT NOT NULL,
    id_produto INT NOT NULL,
    quantidade INT,
    preco_unitario DECIMAL(10,2), 
    FOREIGN KEY (id_pedido) REFERENCES pedidos(id),
    FOREIGN KEY (id_produto) REFERENCES produtos(id)
);

-- ==========================================================
-- INSERÇÃO DE PRODUTOS (CATÁLOGO BLACK FRIDAY 2025)
-- ==========================================================

INSERT INTO produtos (nome, descricao, preco_normal, preco_promo, imagem, categoria) VALUES

-- 1. CELULARES
('iPhone 17 Pro Max', 'Titanium, Chip A19 Pro, 512GB, Tela 6.9", Câmera 48MP Tetraprisma.', 11500.00, 9899.00, 'assets/img/iphone-17-pro.png', 'Celulares'),
('iPhone 17', 'Chip A18, 256GB, Tela OLED 120Hz ProMotion, Ilha Dinâmica Reduzida.', 7900.00, 6499.00, 'assets/img/iphone-17.png', 'Celulares'),
('Xiaomi 15 Pro 5G', 'Lentes Leica Summilux, Snapdragon 8 Gen 4, 16GB RAM, Carregamento 120W.', 5200.00, 3899.90, 'assets/img/xiaomi-15.jpeg', 'Celulares'),

-- 2. VIDEO GAMES
('PlayStation 5 Pro', 'GPU com Ray Tracing Avançado, 2TB SSD, PSSR Upscaling, 4K 60FPS Estável.', 6900.00, 5499.00, 'assets/img/ps5-pro.png', 'Video Games'),
('Nintendo Switch 2', 'Nova Geração, Tela 8" 1080p, DLSS, Retrocompatibilidade total com Switch 1.', 4200.00, 3299.00, 'assets/img/switch-2.png', 'Video Games'),
('Xbox Series X (Galaxy)', 'Edição Especial Galaxy Black, 2TB SSD, Novo Controle Hápitco Imersivo.', 5500.00, 4499.00, 'assets/img/xbox-galaxy.png', 'Video Games'),

-- 3. MONITORES
('Monitor ASUS ROG OLED', '32" 4K QD-OLED, 240Hz, 0.03ms, HDR True Black 400, USB-C 90W.', 9500.00, 7999.00, 'assets/img/monitor-rog.png', 'Monitores'),
('Monitor Samsung Neo G9', '57" Dual UHD (7680x2160), Curvo 1000R, Mini-LED, 240Hz, HDMI 2.1.', 16000.00, 12499.00, 'assets/img/monitor-g9.png', 'Monitores'),
('Monitor AOC Hero Quad', '27" QHD 2K, 155Hz, 1ms, Painel IPS, Base Ajustável, G-Sync Compatible.', 2100.00, 1599.90, 'assets/img/monitor-aoc.png', 'Monitores');

