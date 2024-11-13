<?php

declare(strict_types=1);

namespace DEON\Mvc\Controller;

use DEON\Mvc\Entity\Video;
use DEON\Mvc\Repository\VideoRepository;


class EditVideoController implements Controller
{
    private const SENHA_CORRETA = 'Luppi#1505';
    public function __construct(private VideoRepository $videoRepository)
    {
    }

    public function processaRequisicao(): void
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        session_start();
        if (isset($_SESSION['bloqueioTemporario']) && $_SESSION['bloqueioTemporario'] > time()) {
            $tempoRestante = $_SESSION['bloqueioTemporario'] - time();
            header('Location: /?sucesso=0&bloqueado=1&tempo=' . $tempoRestante);
            return;
        }


        if (!isset($_SESSION['tentativasSenha'])) {
            $_SESSION['tentativasSenha'] = 0;
        }

        $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);

        if ($senha !== self::SENHA_CORRETA) {
            $_SESSION['tentativasSenha']++;

            if ($_SESSION['tentativasSenha'] >= 3) {
                $_SESSION['bloqueioTemporario'] = time() + 60;
                header('Location: /?sucesso=0&bloqueado=1');
                return;
            }
            header('Location: /?sucesso=0');
            return;
        }

        if ($senha !== self::SENHA_CORRETA) {
            header('Location: /?sucesso=0');
            return;
        }


        $url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);
        $url = TransformEmbedController::embedYouTubeVideo($url);
        if ($url === false) {
            header('Location: /?sucesso=0');
            return;
        }
        $titulo = filter_input(INPUT_POST, 'titulo');
        if ($titulo === false) {
            header('Location: /?sucesso=0');
            return;
        }
        $titulo = htmlspecialchars($titulo, ENT_QUOTES, 'UTF-8');

        $video = new Video($url, $titulo);
        $video->setId($id);

        $success = $this->videoRepository->update($video);

        if ($success === false) {
            header('Location: /?sucesso=0');
        } else {
            header('Location: /?sucesso=1');
        }
    }
}