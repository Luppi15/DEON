<?php

declare(strict_types=1);

use DEON\Mvc\Controller\{
    Controller,
    DeleteVideoController,
    EditVideoController,
    Error404,
    NewVideoController,
    VideoFormController,
    VideoListController,
    TransformEmbedController,
};
use DEON\Mvc\Repository\VideoRepository;

require_once __DIR__ . '/../vendor/autoload.php';

if(isset($_GET['evento'])) {
    $database = $_GET['evento'];
    $dbPath = __DIR__ . "/../Databases/$database.database.sqlite";
}else{
    $dbPath = __DIR__ . "/../Databases/database.sqlite";
}


if (file_exists($dbPath)) {
    try {
        $pdo = new PDO("sqlite:$dbPath");
    } catch (PDOException $e) {
        die("Erro ao conectar ao banco de dados: " . $e->getMessage());
    }
} else {
    header("Location: /404-error");
    exit;
}
$videoRepository = new VideoRepository($pdo);

$routes = require_once __DIR__ . '/../config/routes.php';

$pathInfo = $_SERVER['PATH_INFO'] ?? '/';
$httpMethod = $_SERVER['REQUEST_METHOD'];

$key = "$httpMethod|$pathInfo";
if (array_key_exists($key, $routes)) {
    $controllerClass = $routes["$httpMethod|$pathInfo"];

    $controller = new $controllerClass($videoRepository);
} else {
    $controllerClass = $routes["GET|/404-error"];

    $controller = new $controllerClass($videoRepository);
}
/** @var Controller $controller */
$controller->processaRequisicao();
