<?php

namespace ReadBundle\Repository;

use ReadBundle\Entity\Acervo;

/**
 * AcervoRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AcervoRepository extends \Doctrine\ORM\EntityRepository
{
    public function save(Acervo $acervo)
    {
        $this->getEntityManager()->persist($acervo);
        $this->getEntityManager()->flush($acervo);
    }
}