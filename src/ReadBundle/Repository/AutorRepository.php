<?php

namespace ReadBundle\Repository;

use ReadBundle\Entity\Autor;

/**
 * AutorRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AutorRepository extends \Doctrine\ORM\EntityRepository
{
    public function save(Autor $autor)
    {
        $this->getEntityManager()->persist($autor);
        $this->getEntityManager()->flush($autor);
    }
}