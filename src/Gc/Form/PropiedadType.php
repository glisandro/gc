<?php
  
namespace Gc\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Gc\Form;
use Gc\Form\EventListener\AddConsorcioFieldSubscriber;

class PropiedadType extends AbstractType
{
    
    public $consorcio  = null;
    
    public function __construct($consorcio) 
    {
        $this->consorcio = $consorcio;    
    }
    
    public function getName()
    {
        return 'propiedades';
    }
  
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {   
        
        $factory = $builder->getFormFactory();
        $consorcioSubscriber = new AddConsorcioFieldSubscriber($factory, $this->consorcio);
        $builder->addEventSubscriber($consorcioSubscriber);
        
        $builder->add('piso', 'text', array('required' => false));
        
        $builder->add('depto', 'text', array('required' => false));
        $builder->add('otros', 'text', array('required' => false));
        $builder->add('porcentualidadA', 'text', array('required' => false));
        $builder->add('porcentualidadB', 'text', array('required' => false));
        
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {   
        $resolver->setDefaults(array(
            'data_class' => 'Gc\Entity\Propiedad'
        ));
    }
}