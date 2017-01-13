<?php
namespace Project\AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Project\AppBundle\DataControl\DCIngredients;
use Project\CoreBundle\DataControl\Base\DCContainer;
use Project\CoreBundle\DataControl\Behaiviour\ModifyQueryBuilderInterface;
use Project\CoreBundle\DataControl\Paginator\HtmlPaginator;

/**
 * CocktailComponentRepository
 */
class CocktailComponentRepository extends EntityRepository
{
    /**
     * @param ModifyQueryBuilderInterface $dc
     *
     * @return int
     */
    public function countCocktails(ModifyQueryBuilderInterface $dc)
    {
        $qb = $this
            ->createQueryBuilder('cc')
            ->select('count(DISTINCT cc.cocktail)');

        $dc->modifyQueryBuilder($qb);

        return (int) $qb
            ->getQuery()
            ->getSingleScalarResult();
    }

    /**
     * @param DCContainer $dcc
     *
     * @return array
     */
    public function findMostSuitable(DCContainer $dcc)
    {
        /* @var DCIngredients $dcIngredient*/
        $dcIngredient = $dcc->get(DCIngredients::NAME);
        $ingredients = implode(', ', array_map(function($item) {return (int) $item; }, $dcIngredient->getCollection()));
        /* @var HtmlPaginator $paginator*/
        $paginator = $dcc->get(HtmlPaginator::NAME);

        $statement = $this
            ->getEntityManager()
            ->getConnection()
            ->prepare('
                SELECT cc.cocktail_id, SUM(ingredient_id IN (' . $ingredients . ')) as coincides, SUM(ingredient_id NOT IN (' . $ingredients . ')) as miss
                FROM cocktail_component cc 
                INNER JOIN ingredient i ON cc.ingredient_id = i.id
                GROUP BY cc.cocktail_id
                HAVING coincides > 0
                ORDER BY coincides DESC, miss ASC
                ' . $paginator->getSQL() . '
            ');
        $statement->execute();

        return $statement->fetchAll();
    }
}