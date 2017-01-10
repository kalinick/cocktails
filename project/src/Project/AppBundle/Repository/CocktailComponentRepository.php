<?php
namespace Project\AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class CocktailComponentRepository
 */
class CocktailComponentRepository extends EntityRepository
{
    /**
     * @param array $ingredientIds
     *
     * @return array
     */
    public function findMostSuitable(array $ingredientIds)
    {
        $ingredients = implode(', ', $ingredientIds);
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
            ');
        $statement->execute();

        return $statement->fetchAll();
    }
}