<?php
  
namespace Gc\Form\EventListener;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Doctrine\ORM\EntityRepository;
use Gc\Entity\Propiedad;

class AddConsorcioFieldSubscriber implements EventSubscriberInterface
{
    private $factory;
    private $consorcio;

    public function __construct(FormFactoryInterface $factory, $consorcio)
    {
        $this->factory = $factory;
        $this->consorcio = $consorcio;
    }

    public static function getSubscribedEvents()
    {
        return array(
            FormEvents::SUBMIT => 'onSubmit'
        );
    }
    
    public function onSubmit(FormEvent $event)
    {   
        $propiedad = $event->getData();
        $form = $event->getForm();
        
        if (!$propiedad || !$propiedad->getId()) {
            $propiedad->setConsorcio($this->consorcio);
        }

    }
}