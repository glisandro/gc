<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

$app->get('/', function () use ($app) {
    return $app['twig']->render('index.html', array());
})
->bind('homepage')
;

$app->match('/consorcio/{consorcioid}', controller('consorcios/index'))->bind('consorcios');
$app->match('/consorcio/{consorcioid}/propiedades', controller('propiedades/index'))->bind('propiedades');

$app->before(function() use ($app){
    
    // for the menu
    $consorcios = $app['em']->getRepository('Gc\Entity\Consorcio')->findAll();
    $app['twig']->addGlobal('consorcios', $consorcios);

    // for the item product
    $firstconsorcioid = $app['em']->getRepository('Gc\Entity\Consorcio')->getFirst();
    
    $consorcioid = (int) $app['request']->get('consorcioid',0);
    
    if ($consorcioid == 0) {
       $app['twig']->addGlobal('consorcioid', $firstconsorcioid);
    } else {
        $app['twig']->addGlobal('consorcioid', $consorcioid);
    }
    
    $app['twig']->addGlobal('firstconsorcioid', $firstconsorcioid);
});

$app->error(function (\Exception $e, $code) use ($app) {
    if ($app['debug']) {
        return;
    }

    $page = 404 == $code ? '404.html' : '500.html';

    return new Response($app['twig']->render($page, array('code' => $code)), $code);
});

function controller($shortName)
{
    list($shortClass, $shortMethod) = explode('/', $shortName, 2);

    return sprintf('Gc\Controller\%sController::%sAction', ucfirst($shortClass), $shortMethod);
}
