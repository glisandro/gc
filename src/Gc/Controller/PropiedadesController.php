<?php

namespace Gc\Controller;

use Silex\ControllerProviderInterface;
use Silex\Application;
use Silex\ControllerCollection;
use Silex\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\FormError;
use Gc\Entity;
use Gc\Form\PropiedadType;
use Gc\Form\PropiedadesType;


class PropiedadesController{
    
    public function indexAction($consorcioid, Request $request, Application $app)
    {   
        $propiedades = $app['em']->getRepository('Gc\Entity\Propiedad')->getPropiedadesByConsorcio($consorcioid);
        $form = $app['form.factory']->create(new PropiedadesType(), $propiedades);
        
        if ($request->isMethod("POST")) {
            $form->bind($request);
            
            if ($form->isValid()) {
                
                $app['em']->flush();
                
                $memcache_obj = new \Memcache;
                $memcache_obj->connect('localhost', 11211);
                $memcache_obj->delete('prop_'.$consorcioid);
                
                $app['session']->getFlashBag()->add('success', 'Se editó correctamente');
                return $app->redirect($app['url_generator']->generate('propiedades',array('consorcioid' => $consorcioid)));
            } else {
                $app['session']->getFlashBag()->add('error', 'El formulario contiene errores.');
            }
        }
        
        return $app['twig']->render('gc/propiedades/index.html.twig', array(
            'form' => $form->createView()
        ));
      
 
    }
    
    
}