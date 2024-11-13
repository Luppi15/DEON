<?php

declare(strict_types=1);

namespace DEON\Mvc\Controller;
use DEON\Mvc\Repository\EventsRepository;

class HubEventsController implements Controller
{
    public function processaRequisicao(): void
    {


        require_once  __DIR__ . '/../../views/eventos-list.php';
    }
}
