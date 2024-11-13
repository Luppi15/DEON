<header>

    <nav class="cabecalho">
        <a class="logo" href="/">
            <img src="/img/cabecalho/logo.png" alt="">
        </a>

        <div class="titulo--DEON--container">
            <span onclick="window.location.href='/'" class="titulo--DEON rgb">DEON</span>
        </div>

        <div class="cabecalho__icones">

            <?php
                if($_GET['player'] === 'true'){
                    echo '<a href="/novo-video?evento=' . $database . '&editavel=false" class="cabecalho__videos"></a>';
                }
            ?>
        </div>
    </nav>

</header>
