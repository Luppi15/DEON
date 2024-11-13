<?php
require_once __DIR__ . '/inicio-html.php';
require_once __DIR__ . '/cabecalho.php';
$database = $_GET['evento']
/** @var \DEON\Mvc\Entity\Video|null $video */
?>
<main class="container">
<form class="container__formulario" method="post">
    <?php
    if($_GET['deleteform'] === 'true'){
        echo '<!--';
    }
    ?>

    <div class="formulario__campo">
        <label class="campo__etiqueta" for="url">Link do vídeo</label> </br> 
        <input name="url"
               value="<?= $video?->url; ?>"
               class="campo__escrita"
               required=""
               placeholder="Por exemplo: https://www.youtube.com/watch?v=MZQKk-OTyf4"
               id='url' />
        <span class="campo__escrita-border campo__escrita-border-alt"></span>
    </div>

    <div class="formulario__campo">
        <label class="campo__etiqueta" for="titulo">Título do vídeo</label> </br> 
        <input name="titulo"
               value="<?= $video?->title; ?>"
               class="campo__escrita"
               required=""
               placeholder="Neste campo, dê o nome do vídeo."
               type="text"
               id='titulo' 
               name="titulo" 
               autocomplete="off"/>
        <span class="campo__escrita-border campo__escrita-border-alt"></span>
    </div>

    <?php 
    if($_GET['deleteform'] === 'true'){
        echo '-->';
    }
    ?>

    <div class="formulario__campo">
        <label class="campo__etiqueta" for="senha">Senha de acesso</label> </br> 
        <input name="senha"
               value=""
               class="campo__escrita"
               required=""
               placeholder="Caso seja um administrador, informe a senha aqui."
               type="password"
               id="password" 
               name="password" 
               autocomplete="current-password"/>
        <span class="campo__escrita-border campo__escrita-border-alt"></span>
    </div> 

    <div class="submit--formulario--buttons">
        <button class="formulario__botao" type="submit"><span><?php

                if($_GET['deleteform'] === 'true'){
                    echo 'Deletar';
                }else{
                    echo 'Enviar';
                }

        ?></span></button>
    </div>
</form>


    <div class="delete__button">
    <?php
        $url = $_GET['editavel'];
        if($url === 'true'){
            echo '<a href="/remover-video-form?id=' . $video->id . '&evento=' . $database . '&deleteform=true" class="delete__button__link"><button class="formulario__botao" type="submit"><span>excluir</span></button></a>';
        }
    ?>

    
    </div>

</main>

<?php
require_once __DIR__ . '/fim-html.php';