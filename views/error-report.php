<?php
$erro = $_GET['erro'];
require_once __DIR__ . '/inicio-html.php';
?>

<div class="error-container">
    <h1 class="titulo--error">erro de <?=$erro?></h1>
</div>

