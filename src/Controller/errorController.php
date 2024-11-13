<?php

namespace DEON\Mvc\Controller;

class errorController implements Controller
{

    public function processaRequisicao(): void
    {
        require_once __DIR__ . '/../../views/error-report.php';
    }
}