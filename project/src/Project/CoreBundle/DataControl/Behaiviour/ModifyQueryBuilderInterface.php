<?php
namespace Project\CoreBundle\DataControl\Behaiviour;

use Doctrine\ORM\QueryBuilder;

/**
 * ModifyQueryBuilder
 */
interface ModifyQueryBuilderInterface
{
    /**
     * @param QueryBuilder $qb
     *
     * @return $this
     */
    public function modifyQueryBuilder(QueryBuilder $qb);
}
