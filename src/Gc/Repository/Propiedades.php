<?php

namespace Gc\Repository;

use Doctrine\ORM\EntityRepository;

class Propiedades extends EntityRepository
{
    public $propiedades;
    
    public function getPropiedadesByFilter($app, $consorcio_id)
    {

        $query = $this->_em->createQueryBuilder();// createQueryBuilder('SELECT p FROM Northwind\Entity\Product WHERE 1 p ORDER BY p.category');
        $query->select('p')
              ->from('Gc\Entity\Propiedad', 'p')
              ->orderBy('p.category');
              
        if ($consorcio_id > 0) {
            $query->andWhere('p.category = ?1');
            $query->setParameter(1,$consorcio_id);    
        }
        /*
        if (!empty($productname)) {
            $query->andWhere($query->expr()->like('p.productname', '?2'));
            $query->setParameter(2,'%'.$productname.'%');
        }*/
        
        $pagerfanta = $app['pagerfanta.pager_factory']->getForDoctrineORM($query)
            ->setMaxPerPage(15)
            ->setCurrentPage(1);
        
        return $pagerfanta;
    }
    
    public function getPropiedadesByConsorcio($consorcio_id) 
    {
        
        
        $this->propiedades = $this->_em->getRepository('Gc\Entity\Propiedad')->findBy(array('consorcio' => $consorcio_id));
      
        
        return $this;
        
        
    }
    
     public function removePropiedad(\Gc\Entity\Propiedad $propiedad) 
    {
        $this->_em->remove($propiedad);    
    }
    
    public function addPropiedad(\Gc\Entity\Propiedad $propiedad) 
    {
       $this->_em->persist($propiedad);
    } 
}


            