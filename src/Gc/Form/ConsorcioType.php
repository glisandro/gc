<?php
  
namespace Gc\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Gc\Form;

class ConsorcioType extends AbstractType
{
    public function getName()
    {
        return 'consorcio';
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('consorcioname', 'text');
        /*$builder->add('quantityPerUnit', 'text');
        $builder->add('discontinued', 'checkbox', array('required' => false));
        $builder->add('category','entity', array(
            'class' => 'Gc\Entity\Category',
            'property' => 'categoryname',
            'multiple' => false
        )); */
        //$builder->add('orderid','collection', array( 'type' => new Form\OrderType()));
        
        //$builder->add('category', new Form\CategoryType());
        /*$builder->add($builder->create('categoryid', 'form', array('by_reference' => false))
            ->add('categoryName', new Form\CategoryType()));*/
        
         
       /* $builder->add('categoryid', 'choice',
            array('choice_list' => new \Symfony\Component\Form\Extension\Core\ChoiceList\SimpleChoiceList(array('a'='valor a'))
        ));*/ 
        
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Gc\Entity\Consorcio'
        ));
    }
}