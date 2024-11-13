<?php

use DEON\Mvc\Repository\EventsRepository;

require_once __DIR__ . '/inicio-html.php';
require_once __DIR__ . '/cabecalho.php';

$bancoEventos = new EventsRepository();
$listaEventos = $bancoEventos->getRepositories();

?>

<ul class="videos__container">

    <?php foreach ($listaEventos as $evento): ?>
        <li class="events__list">
            <a href="/video-list?evento=<?= htmlspecialchars($evento['nome']) ?>&player=true">
                <div class="card">
                    <img class="image__card" src="<?= htmlspecialchars($evento['imagem']) ?>" alt="<?= htmlspecialchars($evento['nome']) ?>">
                    <div class="card__content">
                        <h1 class="card__title rgb"><?= htmlspecialchars($evento['nome']) ?></h1>
                        <p class="card__description"><?= htmlspecialchars($evento['descricao']) ?></p>
                    </div>
                </div>
            </a>
            <span class="event__name"><?= htmlspecialchars($evento['nome']) ?></span>
        </li>
    <?php endforeach; ?>



</ul>
