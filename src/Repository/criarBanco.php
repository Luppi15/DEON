<?php

$dbPath = __DIR__ . '/../../Databases/database.sqlite';
$pdo = new PDO("sqlite:$dbPath");
$pdo->exec('CREATE TABLE dados (nome TEXT, descricao TEXT, imagem TEXT, senha TEXT);');