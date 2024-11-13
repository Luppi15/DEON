<?php
if(isset($_GET['evento'])) {
    $database = $_GET['evento'];
} else {
    header('location: /');
}

require_once __DIR__ . '/inicio-html.php';
require_once __DIR__ . '/cabecalho.php';

$dbPath = __DIR__ . "/../Databases/$database.database.sqlite";
/** @var \DEON\Mvc\Entity\Video[] $videoList */

// Função para extrair o ID do vídeo do YouTube
function getYouTubeVideoId($url) {
    $parsedUrl = parse_url($url);
    if ($parsedUrl['host'] === 'youtu.be') {
        return substr($parsedUrl['path'], 1);
    } elseif (strpos($parsedUrl['path'], 'embed') !== false) {
        return end(explode('/', $parsedUrl['path']));
    } else {
        parse_str($parsedUrl['query'], $queryParams);
        return $queryParams['v'] ?? null;
    }
}
?>

<ul class="videos__container">
    <?php foreach ($videoList as $video): ?>
        <?php
        $videoId = getYouTubeVideoId($video->url);
        if ($videoId) {
            $thumbnailUrl = "https://img.youtube.com/vi/$videoId/hqdefault.jpg";
        } else {
            $thumbnailUrl = "caminho/para/imagem/padrao.jpg"; // Substitua por uma imagem padrão se o ID não for encontrado
        }
        ?>
        <li class="videos__item">
            <div class="video-container">
                <img class="video-thumbnail" src="<?= $thumbnailUrl; ?>" alt="<?= $video->title; ?>">
                <div class="video-iframe-container" data-video-url="<?= $video->url; ?>"></div>
            </div>
            <div class="descricao-video">
                <h3><?= $video->title; ?></h3>
                <div class="acoes-video">
                    <a href="/editar-video?id=<?= $video->id; ?>&evento=<?=$database?>&editavel=true">Editar</a>
                </div>
            </div>
        </li>
    <?php endforeach; ?>
</ul>

<?php require_once __DIR__ . '/fim-html.php'; ?>
