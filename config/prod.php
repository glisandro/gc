<?php

// configure your app for the production environment
// Doctrine (db)
$app['db.options'] = array(
    'driver'   => 'pdo_mysql',
    'host'     => 'localhost',
    'dbname'   => 'gc',
    'user'     => 'root',
    'password' => '',
);