<?php

namespace AppBundle\RubFromTheme;

class RubFromTheme
{

    private $id;
    private $em;  

    public function __construct($id, \Doctrine\ORM\EntityManager $entityManager)
    {
      $this->id = $id;
    }
    
    public function getRubriqueFromTheme()    
    {
    $qb = $this->createQueryBuilder('r')      
                ->where('r.theme= :theme')
                ->setParameter('theme', $theme);
     
    return $qb->getQuery()
              ->getResult();
    }
}