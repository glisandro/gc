<?php

namespace Gc\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

class Consorcios extends EntityRepository
{
    public function findAll()
    {
        return $this->_em->getRepository('Gc\Entity\Consorcio')->findBy(array(),array('consorcioname'=>'asc'));
    }
    
    public function getFirst()
    {    
        $query = $this->_em->createQuery('SELECT c.id, c.consorcioname FROM Gc\Entity\Consorcio c ORDER BY c.consorcioname asc')->setFirstResult(0)
                       ->setMaxResults(1);
        
        $result = $query->execute();
        
        return (isset($result[0]['id'])) ? $result[0]['id'] : 0;
        
        
        return $query->execute(array(), Query::HYDRATE_SCALAR);
    }
    
    public function getAllCategoriesArray()
    {
        $query = $this->_em->createQuery('SELECT c.categoryid,c.categoryname FROM Northwind\Entity\Category c');
        $categories = $query->execute(array(), Query::HYDRATE_SCALAR);
        
       /* $result = $this->_em->getRepository('Northwind\Entity\Category')->getSingleResult()
                         ->findAll(); */
        $arrCategories = array();
        foreach($categories as $category)
            $arrCategories[$category['categoryid']] = $category['categoryname'];
            
        //echo '<pre>';
        //var_dump($arrCategories);exit;
        return $arrCategories;
        
    }
}

