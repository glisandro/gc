<?php

use Silex\Application;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;
use Silex\Provider\ValidatorServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\FormServiceProvider;
use Silex\Provider\MonologServiceProvider;
use Silex\Provider\WebProfilerServiceProvider;
use Symfony\Bridge\Doctrine\Form\DoctrineOrmExtension;
use Silex\Provider\TranslationServiceProvider;
use Symfony\Component\Translation\Loader\YamlFileLoader;
use Silex\Provider\SessionServiceProvider;



$app->register(new UrlGeneratorServiceProvider());
$app->register(new ValidatorServiceProvider());
$app->register(new ServiceControllerServiceProvider());
$app->register(new TwigServiceProvider(), array(
    'twig.path'    => array(__DIR__.'/../templates'),
    'twig.options' => array('cache' => __DIR__.'/../cache/twig'),
));
$app['twig'] = $app->share($app->extend('twig', function($twig, $app) {
    // add custom globals, filters, tags, ...
    return $twig;
}));

if($app['debug']) {
    $app->register(new MonologServiceProvider(), array(
        'monolog.logfile' => __DIR__.'/../logs/silex_dev.log',
    ));

    $app->register($p = new WebProfilerServiceProvider(), array(
        'profiler.cache_dir' => __DIR__.'/../cache/profiler',
    ));
    $app->mount('/_profiler', $p);
}

$app->register(new FormServiceProvider());

$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    $app['db.options']
));
/*
$app->register(new KevinGH\Entities\EntitiesServiceProvider(), array(
    'em.options' => array(
        'flush_on_terminate' => false,
        'mapping_paths' => array(
            __DIR__ . '/GC/Entity'
        ),
        'proxy_dir' => __DIR__ . '/GC/Proxy',
        'proxy_namespace' => 'GC\Proxy',
        'proxy_auto_generate' => $app['debug']
    )
));*/

$app->register(new Dominikzogg\Silex\Provider\DoctrineOrmManagerRegistryProvider());
$app['form.extensions'] = $app->share(
    $app->extend('form.extensions', function ($extensions, $app) {
        $extensions[] = new Symfony\Bridge\Doctrine\Form\DoctrineOrmExtension($app['doctrine']);

    return $extensions;
}));

$app->register(new Dflydev\Silex\Provider\DoctrineOrm\DoctrineOrmServiceProvider(), array(
    "orm.proxies_dir" => __DIR__. "/Gc/Proxy",
    "orm.em.options" => array(
        "mappings" => array(
            // Using actual filesystem paths
            array(
                "type" => "annotation",
                "namespace" => 'Gc\Entity',
                "path" => __DIR__ . '/GC/Entity',
            )
        ),
    ),
));
$app['em'] = $app['doctrine']->getManager('default');

$app->register(new TranslationServiceProvider());
$app['translator'] = $app->share($app->extend('translator', function($translator, $app) {
    $translator->addLoader('yaml', new YamlFileLoader());
    $translator->addResource('yaml', __DIR__.'/../resources/locales/es.yml', 'es');
    return $translator;
}));
$app->register(new Silex\Provider\TranslationServiceProvider(), array(
    'translator.messages' => array(),
));
/* 
$app['form.extensions'] = $app->share($app->extend('form.extensions', function ($extensions) use($app) {
    $managerRegistry = new ManagerRegistry(null, array(), array('em'), null, null, '\Doctrine\ORM\Proxy\Proxy');
    $managerRegistry->setContainer($app);
    $extensions[] = new DoctrineOrmExtension($managerRegistry);
     
    return $extensions;
}));
*/

$app->register(new SessionServiceProvider());

//return $app;
