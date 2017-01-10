<?php
namespace Project\AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Project\AppBundle\Entity\Cocktail;

/**
 * Class CocktailRepository
 */
class CocktailRepository extends EntityRepository
{
    /**
     * @param $page
     *
     * @return Cocktail[]
     */
    public function findAllWithLimit($page)
    {
        return $this
            ->createQueryBuilder('c')
            ->setFirstResult($page * 10)
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();
    }

    /**
     * @param array $ids
     *
     * @return Cocktail[]
     */
    public function findByIds(array $ids)
    {
        return $this
            ->createQueryBuilder('c')
            ->select('c, ct, cc, cct')
            ->innerJoin('c.translations', 'ct')
            ->innerJoin('c.cocktailComponents', 'cc')
            ->innerJoin('cc.translations', 'cct')
            ->where('c.id IN (:ids)')
            ->orderBy('FIELD (c.id, :ids)')
            ->setParameter('ids', $ids)
            ->getQuery()
            ->getResult();
    }
}