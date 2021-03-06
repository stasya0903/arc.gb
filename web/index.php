<?php

use Framework\Command\CommandInvoker;
use Framework\Command\LoadConfigCommand;
use Framework\Command\LoadRoutesCommand;
use Framework\Registry;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpFoundation\Request;

/**
 * FRONT CONTROLLER
 * Создает обьект Kernel
 * конфигурирует его создавая контейнер, добавляя конфигурации и роуты
 * создает обьект Request
 * передает обьект Request в Kernel вызывая метод обработки запроса и
 * получая ответ отправляет его
 **/

require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR .
    'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

$request = Request::createFromGlobals();
$containerBuilder = new ContainerBuilder();

Registry::addContainer($containerBuilder);


$kernel = (new Kernel($containerBuilder));

$commandsInvoker = new CommandInvoker();
$commandsInvoker->addCommand(new LoadConfigCommand($kernel));
$commandsInvoker->addCommand(new LoadRoutesCommand($kernel));

$commandsInvoker->runAllCommands();

$response = $kernel->handle($request);
$response->send();

