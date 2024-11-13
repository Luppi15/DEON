<?php

declare(strict_types=1);

namespace DEON\Mvc\Controller;

use DEON\Mvc\Repository\EventsRepository;
use DEON\Mvc\Repository\VideoRepository;

class DeleteVideoController implements Controller
{
    public function __construct(private VideoRepository $videoRepository)
    {
    }
    public function processaRequisicao(): void
    {
        session_start();
        if (isset($_SESSION['bloqueioTemporario']) && $_SESSION['bloqueioTemporario'] > time()) {
            $tempoRestante = $_SESSION['bloqueioTemporario'] - time();
            header('Location: /?sucesso=0&bloqueado=1&tempo=' . $tempoRestante);
            return;
        }


        if (!isset($_SESSION['tentativasSenha'])) {
            $_SESSION['tentativasSenha'] = 0;
        }

        $repository = new EventsRepository();
        $senhaCorreta = $repository->getSenha();
        $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);

        if ($senha !== $senhaCorreta) {
            $_SESSION['tentativasSenha']++;

            if ($_SESSION['tentativasSenha'] >= 3) {
                $_SESSION['bloqueioTemporario'] = time() + 60;
                header('Location: /?sucesso=0&bloqueado=1');
                return;
            }
            header('Location: /?sucesso=0');
            return;
        }

        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if ($id === null || $id === false) {
            header('Location: /?sucesso=0');
            return;
        }

        $success = $this->videoRepository->remove($id);
        if ($success === false) {
            header('Location: /?sucesso=0');
        } else {
            header('Location: /?sucesso=1');
        }

    }
}
