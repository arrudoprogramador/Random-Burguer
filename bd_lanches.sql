CREATE TABLE users (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    name VARCHAR(120) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    telefone VARCHAR(20),

    password VARCHAR(255) NOT NULL,

    role ENUM('admin', 'cliente') DEFAULT 'cliente',

    foto VARCHAR(255) NULL,

    ativo BOOLEAN DEFAULT TRUE,

    email_verified_at TIMESTAMP NULL,

    remember_token VARCHAR(100) NULL,

    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    deleted_at TIMESTAMP NULL
);

CREATE TABLE categorias (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    nome VARCHAR(100) NOT NULL UNIQUE,

    slug VARCHAR(120) NOT NULL UNIQUE,

    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);

CREATE TABLE lanches (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    categoria_id BIGINT UNSIGNED NOT NULL,

    nome VARCHAR(150) NOT NULL,

    slug VARCHAR(180) NOT NULL UNIQUE,

    descricao TEXT NOT NULL,

    imagem VARCHAR(255) NULL,

    preco DECIMAL(10,2) NOT NULL,

    estoque INT DEFAULT 0,

    destaque BOOLEAN DEFAULT FALSE,

    ativo BOOLEAN DEFAULT TRUE,

    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    deleted_at TIMESTAMP NULL,

    CONSTRAINT fk_lanche_categoria
        FOREIGN KEY (categoria_id)
        REFERENCES categorias(id)
        ON DELETE CASCADE
);

CREATE TABLE pedidos (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    user_id BIGINT UNSIGNED NOT NULL,

    status ENUM(
        'pendente',
        'preparando',
        'entregando',
        'concluido',
        'cancelado'
    ) DEFAULT 'pendente',

    subtotal DECIMAL(10,2) NOT NULL,

    taxa_entrega DECIMAL(10,2) DEFAULT 0,

    desconto DECIMAL(10,2) DEFAULT 0,

    total DECIMAL(10,2) NOT NULL,

    observacoes TEXT NULL,

    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,

    CONSTRAINT fk_pedido_user
        FOREIGN KEY (user_id)
        REFERENCES users(id)
        ON DELETE CASCADE
);

CREATE TABLE pedido_itens (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    pedido_id BIGINT UNSIGNED NOT NULL,

    lanche_id BIGINT UNSIGNED NOT NULL,

    quantidade INT NOT NULL DEFAULT 1,

    preco_unitario DECIMAL(10,2) NOT NULL,

    subtotal DECIMAL(10,2) NOT NULL,

    observacao TEXT NULL,

    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,

    CONSTRAINT fk_item_pedido
        FOREIGN KEY (pedido_id)
        REFERENCES pedidos(id)
        ON DELETE CASCADE,

    CONSTRAINT fk_item_lanche
        FOREIGN KEY (lanche_id)
        REFERENCES lanches(id)
        ON DELETE CASCADE
);

CREATE TABLE enderecos (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    user_id BIGINT UNSIGNED NOT NULL,

    cep VARCHAR(10),
    rua VARCHAR(150),
    numero VARCHAR(20),
    bairro VARCHAR(100),
    cidade VARCHAR(100),
    estado VARCHAR(2),
    complemento VARCHAR(150),

    principal BOOLEAN DEFAULT FALSE,

    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,

    CONSTRAINT fk_endereco_user
        FOREIGN KEY (user_id)
        REFERENCES users(id)
        ON DELETE CASCADE
);

CREATE TABLE pagamentos (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    pedido_id BIGINT UNSIGNED NOT NULL,

    metodo ENUM(
        'pix',
        'credito',
        'debito',
        'dinheiro'
    ) NOT NULL,

    status ENUM(
        'pendente',
        'pago',
        'falhou',
        'reembolsado'
    ) DEFAULT 'pendente',

    transaction_id VARCHAR(255) NULL,

    valor DECIMAL(10,2) NOT NULL,

    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,

    CONSTRAINT fk_pagamento_pedido
        FOREIGN KEY (pedido_id)
        REFERENCES pedidos(id)
        ON DELETE CASCADE
);


INSERT INTO categorias (id, nome, slug, created_at, updated_at)
VALUES(1, 'Hambúrgueres', 'hamburgueres', NOW(), NOW()),
      (2, 'Bebidas', 'bebidas', NOW(), NOW()),
      (3, 'Combos', 'combos', NOW(), NOW());


INSERT INTO users ( id, name, email, telefone, password, role, ativo, created_at, updated_at)
VALUES (1, 'Administrador', 'admin@randomburguer.com', '11999999999', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/.V5f9Vf9lY6Pe', 'admin', 1, NOW(), NOW() );


INSERT INTO lanches (id, categoria_id, nome, slug, descricao, imagem, preco, estoque, destaque, ativo, created_at, updated_at)
VALUES(1, 1,'Triplo Bacon','triplo-bacon', 'Hambúrguer artesanal com triplo bacon e cheddar.', 'triplo-bacon.jpg', 34.90, 50, 1, 1, NOW(), NOW()),
      (2, 1, 'X-Mata Fome','x-mata-fome', 'Hambúrguer duplo com onion rings e molho especial.', 'x-mata-fome.jpg', 39.90, 40, 1, 1, NOW(), NOW());


INSERT INTO enderecos (id, user_id, cep, rua, numero, bairro, cidade, estado, complemento, principal, created_at, updated_at)
VALUES(1, 1, '01001-000', 'Rua das Palmeiras','120', 'Centro', 'São Paulo', 'SP', 'Apartamento 12', 1, NOW(), NOW()),
      (2, 1, '04567-000', 'Avenida Paulista', '1500', 'Bela Vista','São Paulo', 'SP', 'Casa', 0, NOW(), NOW());

INSERT INTO pedidos (id,user_id, status, subtotal, taxa_entrega, desconto, total, observacoes, created_at, updated_at)
VALUES
    (1, 1, 'pendente', 74.80, 8.00, 0, 82.80, 'Sem cebola', NOW(), NOW()),
    (2, 1, 'concluido', 39.90, 5.00, 0, 44.90, 'Entrega rápida', NOW(), NOW());


INSERT INTO pedido_itens (id, pedido_id, lanche_id, quantidade, preco_unitario, subtotal, observacao, created_at, updated_at)
VALUES
    (1, 1, 1, 1, 34.90, 34.90, 'Ponto da carne bem passado', NOW(), NOW()),
    (2, 1, 2, 1, 39.90, 39.90, 'Sem picles', NOW(), NOW()),
    (3, 2, 2, 1, 39.90, 39.90, NULL, NOW(), NOW());


INSERT INTO pagamentos (id, pedido_id, metodo, status, transaction_id, valor, created_at, updated_at)
VALUES
    (1, 1, 'pix', 'pago', 'PIX-20250324-0001', 82.80, NOW(), NOW());