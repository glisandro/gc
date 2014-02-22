<?php
  
namespace Gc\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Collection;

use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

//use Gc\Entity\Consorcio;
use Gc\Form;

class ConsorciosType extends AbstractType
{

    public function getName()
    {
        return 'consorcios';
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('consorcios', 'collection', array(
            'type'           => new ConsorcioType(),
            'attr' => array('class' => 'table table-striped table-bordered table-hover'),
            //label for each team form type
            'prototype' => true,
            'by_reference'   => true,
            //'prototype_data' => new Propiedad(),
            'allow_delete'   => true,
            'allow_add'      => true,
            'options' => array(
              'attr' => array('class' => 'team-collection')
            ),
        )); 
        
    }
    /*
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Gc\Form\Model\Consorcios'
        ));
    } */
    

}