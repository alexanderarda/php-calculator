#!/usr/bin/env php
<?php

use Illuminate\Console\Application;
use Illuminate\Container\Container;
use Illuminate\Events\Dispatcher;
use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Console\Output\ConsoleOutput;
use Jakmall\Recruitment\Calculator\Drivers\File;
use Jakmall\Recruitment\Calculator\Drivers\Database;
use Illuminate\Database\Capsule\Manager as Capsule;

try {

    require_once __DIR__.'/vendor/autoload.php';

    $container = Container::getInstance();


    $capsule = new Capsule;

    $capsule->addConnection([
        'driver'    => 'mysql',
        'host'      => 'localhost',
        'database'  => 'calculator',
        'username'  => 'root',
        'password'  => 'admin',
        'charset'   => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix'    => '',
    ]);

    // Set the event dispatcher used by Eloquent models
    $capsule->setEventDispatcher(new Dispatcher(new Container));

    // Make this Capsule instance available globally via static methods... (optional)
    $capsule->setAsGlobal();

    // Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
    $capsule->bootEloquent();


    $container->bind('file', function($app) {
        return new File();
    });

    $container->bind('database', function($app) {
        return new Database();
    });


    $dispatcher = new Dispatcher();
    $app = new Application($container, $dispatcher, '0.1');
    $app->setName('Calculator');


    $commands = require_once __DIR__.'/commands.php';
    $commands = collect($commands)
        ->map(
            function ($command) use ($app) {
                return $app->getLaravel()->make($command);
            }
        )
        ->all();

    $app->addCommands($commands);

    $app->run(new ArgvInput(), new ConsoleOutput());

} catch (Throwable $e) {
    var_dump($e);
}
