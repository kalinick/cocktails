<?php
namespace Project\AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Project\AppBundle\Entity\Cocktail;
use Project\CoreBundle\DataControl\Behaiviour\ModifyQueryBuilderInterface;

/**
 * CocktailRepository
 */
class CocktailRepository extends EntityRepository
{
    /**
     * @param ModifyQueryBuilderInterface $dc
     *
     * @return Cocktail[]
     */
    public function findByDC(ModifyQueryBuilderInterface $dc): array
    {
        $qb = $this->createQueryBuilder('c');
        $dc->modifyQueryBuilder($qb);

        return $qb
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
            ->leftJoin('c.cocktailComponents', 'cc')
            ->leftJoin('cc.translations', 'cct')
            ->where('c.id IN (:ids)')
            ->orderBy('FIELD (c.id, :ids)')
            ->setParameter('ids', $ids)
            ->getQuery()
            ->getResult();
    }
}