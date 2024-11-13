<?php

declare(strict_types=1);

return [
    'GET|/' => \DEON\Mvc\Controller\HubEventsController::class,
    'GET|/novo-video' => \DEON\Mvc\Controller\VideoFormController::class,
    'POST|/novo-video' => \DEON\Mvc\Controller\NewVideoController::class,
    'GET|/editar-video' => \DEON\Mvc\Controller\VideoFormController::class,
    'POST|/editar-video' => \DEON\Mvc\Controller\EditVideoController::class,
    'GET|/remover-video' => \DEON\Mvc\Controller\DeleteVideoController::class,
    'GET|/404-error' => \DEON\Mvc\Controller\Error404::class,
    'GET|/video-list' => \DEON\Mvc\Controller\VideoListController::class,
    'GET|/remover-video-form' => \DEON\Mvc\Controller\VideoFormController::class,
    'POST|/remover-video-form' => \DEON\Mvc\Controller\DeleteVideoController::class,
    'GET|/erro-envio' => \DEON\Mvc\Controller\errorController::class,
];
