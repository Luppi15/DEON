<?php

declare(strict_types=1);

namespace DEON\Mvc\Controller;

class Error404 implements Controller
{
    public function processaRequisicao(): void
    {
        require_once  __DIR__ . '/../../views/404-error.php';
    }
}
