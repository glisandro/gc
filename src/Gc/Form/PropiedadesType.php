<?php
  
namespace Gc\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Gc\Form;

class PropiedadesType extends AbstractType
{
    
    public function getName()
    {
        return 'propiedades';
    }
    
    public function __construct($consorcio) 
    {
        $this->consorcio = $consorcio;    
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('propiedades', 'collection', array(
            'type'           => new PropiedadType($this->consorcio),
            'attr' => array('class' => 'table table-striped table-bordered table-hover'),
            //label for each team form type
            'prototype' => true,
            //'label' => false,
            'by_reference'   => true,
            //'prototype_data' => new Propiedad(),
            'allow_delete'   => true,
            'allow_add'      => true,
            'options' => array(
              'attr' => array('class' => 'team-collection')
            ),
        )); 
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Gc\Repository\Propiedades'
        ));
    }
    

}