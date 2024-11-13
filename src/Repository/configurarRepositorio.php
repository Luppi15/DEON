<?php
use DEON\Mvc\Repository\EventsRepository;

require_once 'EventsRepository.php';

const SAIR = 1;
const GERAR_EVENTO = 2;
const DELETAR_EVENTO = 3;

$escolha = 0;

while ($escolha != SAIR) {
    echo 'Bem vindo ao Hub de controle dos eventos do DEON!' . PHP_EOL;
    echo 'Digite sua escolha:' . PHP_EOL;
    echo '[' . SAIR . '] = sair' . PHP_EOL;
    echo '[' . GERAR_EVENTO . '] = Gerar evento' . PHP_EOL;
    echo '[' . DELETAR_EVENTO . '] = Deletar evento' . PHP_EOL;
    $escolha = (int) readline();
    echo '-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-' . PHP_EOL;

    switch ($escolha) {
        case GERAR_EVENTO:
            while ($escolha != SAIR) {
                echo 'Bem vindo ao Hub de adição de eventos do DEON!' . PHP_EOL;

                echo "Digite o nome do repositório: " . PHP_EOL;
                $nome = readline();

                echo "Digite a descrição do repositório: " . PHP_EOL;
                $descricao = readline();

                echo "Digite o link da imagem do repositório: " . PHP_EOL;
                $imagem = readline();

                echo "Digite a senha de acesso do evento: " . PHP_EOL;
                $senha = readline();

                $repository = new EventsRepository();
                $repository->newRepository($nome, $descricao, $imagem, $senha);

                echo '-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-' . PHP_EOL;
                echo 'Digite sua escolha:' . PHP_EOL;
                echo '[' . SAIR . '] = sair' . PHP_EOL;
                echo '[' . GERAR_EVENTO . '] = prosseguir adicionando evento' . PHP_EOL;
                $escolha = (int) readline();

                if ($escolha != SAIR && $escolha != GERAR_EVENTO) {
                    echo 'Digite uma escolha correta!' . PHP_EOL;
                    $escolha = (int) readline();
                }
            }
            break;

        case DELETAR_EVENTO:
            while ($escolha != SAIR) {
                echo "Digite o nome do repositório: " . PHP_EOL;
                $nome = readline();

                $repository = new EventsRepository();
                $repository->deleteRepository($nome);

                echo '-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-' . PHP_EOL;
                echo 'Digite sua escolha:' . PHP_EOL;
                echo '[' . SAIR . '] = sair' . PHP_EOL;
                echo '[' . DELETAR_EVENTO . '] = prosseguir removendo evento' . PHP_EOL;

                $escolha = (int) readline();

                if ($escolha != SAIR && $escolha != DELETAR_EVENTO) {
                    echo 'Digite uma escolha correta!' . PHP_EOL;
                    $escolha = (int) readline();
                }
            }
            break;

        case SAIR:
            // Ação de sair já tratada no loop principal
            break;

        default:
            echo 'Digite uma escolha correta!' . PHP_EOL;
            break;
    }
}
