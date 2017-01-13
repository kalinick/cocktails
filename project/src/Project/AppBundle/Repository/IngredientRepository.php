<?php
namespace Project\AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Project\AppBundle\Entity\Ingredient;

/**
 * IngredientRepository
 */
class IngredientRepository extends EntityRepository
{
    /**
     * @return Ingredient[]
     */
    public function findAllOrdered()
    {
        return $this
            ->createQueryBuilder('i')
            ->select('i', 't', 'it', 'tt')
            ->innerJoin('i.type', 't')
            ->innerJoin('i.translations', 'it')
            ->innerJoin('t.translations', 'tt')
            ->orderBy('t.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @param array $ids
     *
     * @return Ingredient[]
     */
    public function findByIds(array $ids)
    {
        return $this
            ->createQueryBuilder('i')
            ->select('i', 't')
            ->innerJoin('i.type', 't')
            ->where('i.id IN (:ids)')
            ->setParameter('ids', $ids)
            ->getQuery()
            ->getResult();
    }
}