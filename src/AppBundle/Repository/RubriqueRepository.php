<?php

namespace AppBundle\Repository;

/**
 * RubriqueRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class RubriqueRepository extends \Doctrine\ORM\EntityRepository
{
    
  public function getRubriqueFromTheme()    
  {
  $qb = $this->createQueryBuilder('r')      
              ->where('r.theme= :theme')
              ->setParameter('theme', $theme);
   
  return $qb->getQuery()
            ->getResult();
  }

}
