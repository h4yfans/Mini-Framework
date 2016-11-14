<?php

require 'vendor/autoload.php';

$app = new App\App;

$container = $app->getContainer();

$container['config'] = function () {
    return [
        'db_driver' => 'mysql',
        'db_host' => '192.168.10.10',
        'db_name' => 'miniframework',
        'db_user' => 'homestead',
        'db_pass' => 'secret',
    ];
};

$container['db'] = function ($c) {
    return new PDO(
        $c->config['db_driver'] . ':host=' . $c->config['db_host'] . ';dbname=' . $c->config['db_name'],
        $c->config['db_user'],
        $c->config['db_pass']);
};

var_dump($container->config);

