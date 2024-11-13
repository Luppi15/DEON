<?php

declare(strict_types=1);
namespace DEON\Mvc\Repository;
use PDO;

class EventsRepository
{


    public function __construct()
    {
    }


    public function newRepository(string $repositoryName, string $repositoryInfo, string $imagemLink, string $senha):void
    {
        $dbPath = __DIR__ . "/../../Databases/$repositoryName.database.sqlite";
        $pdo = new PDO("sqlite:$dbPath");

        $pdo->exec('CREATE TABLE IF NOT EXISTS videos (id INTEGER PRIMARY KEY, url TEXT, title TEXT);');

        $this->listRepositorio($repositoryName, $repositoryInfo, $imagemLink, $senha);
    }

    public function deleteRepository(string $repositoryName): void
    {
        $dbPath = __DIR__ . "/../../Databases/$repositoryName.database.sqlite";

        try {

            if (file_exists($dbPath)) {

                unlink($dbPath);
                echo "Repositório '$repositoryName' deletado com sucesso.".PHP_EOL;
                $this->unlistRepository($repositoryName);

            } else {

                echo "O repositório '$repositoryName' não existe.";

            }
        } catch (Exception $e) {

            echo 'Erro: ' . $e->getMessage();

        }
    }






    public function listRepositorio(string $repositoryName, string $descrincao, string $urlImagem, string $senha)
    {
        $dbPath = __DIR__ . "/../../Databases/database.sqlite";
        $pdo = new PDO("sqlite:$dbPath");

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


        $stmt = $pdo->prepare('INSERT INTO dados (nome, descricao, imagem, senha) VALUES (:nome, :descricao, :imagem, :senha)');


        $stmt->bindParam(':nome', $repositoryName);
        $stmt->bindParam(':descricao', $descrincao);
        $stmt->bindParam(':imagem', $urlImagem);
        $stmt->bindParam(':senha', $senha);


        $stmt->execute();
    }

    public function unlistRepository(string $repositoryName): void
    {
        $dbPath = __DIR__ . "/../../Databases/database.sqlite";

        try {
            // Conecta ao banco de dados
            $pdo = new PDO("sqlite:$dbPath");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Prepara e executa a instrução SQL para excluir os dados do repositório
            $stmt = $pdo->prepare('DELETE FROM dados WHERE nome = :nome');
            $stmt->bindParam(':nome', $repositoryName);
            $stmt->execute();

            echo "Dados do repositório '$repositoryName' deletados com sucesso." . PHP_EOL;
        } catch (PDOException $e) {
            echo 'Erro: ' . $e->getMessage();
        }
    }


    public function getSenha(): string
    {
        $dbPath = __DIR__ . "/../../Databases/database.sqlite";
        $repositoryName = $_GET['evento'];

        try {
            $pdo = new PDO("sqlite:$dbPath");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $pdo->prepare('SELECT senha FROM dados WHERE nome = :nome');
            $stmt->bindParam(':nome', $repositoryName);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result !== false && isset($result['senha'])) {
                return $result['senha'];
            } else {
                return 'Senha não encontrada para o nome especificado';
            }

        } catch (PDOException $e) {
            echo 'Erro: ' . $e->getMessage();
            return '';
        }
    }



    public function getRepositories(): array
    {
        $dbPath = __DIR__ . "/../../Databases/database.sqlite";

        try {
            // Conecta ao banco de dados
            $pdo = new PDO("sqlite:$dbPath");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Prepara e executa a consulta SQL para obter os dados dos repositórios
            $stmt = $pdo->query('SELECT nome, descricao, imagem, senha FROM dados');
            $repositories = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $repositories;
        } catch (PDOException $e) {
            echo 'Erro: ' . $e->getMessage();
            return [];
        }
    }

}