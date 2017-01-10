<?php
namespace Project\AppBundle\Service;

use Ciklum\DoctrineExtraBundle\Utils\DoctrineAwareTrait;
use Project\AppBundle\Entity\Cocktail;
use Project\AppBundle\Entity\CocktailComponent;

/**
 * Class CocktailFinderService
 */
class CocktailFinderService
{
    use DoctrineAwareTrait;

    /**
     * @param array $ingredientIds
     * @param int   $page
     *
     * @return Cocktail[]
     */
    public function find(array $ingredientIds, $page = 0)
    {
        if (empty($ingredientIds)) {
            return $this->doctrine->getRepository(Cocktail::class)->findAllWithLimit($page);
        }

        $cocktailIds = [];
        $list = $this->doctrine->getRepository(CocktailComponent::class)->findMostSuitable($ingredientIds);
        foreach ($list as $row) {
            $cocktailIds[] = $row['cocktail_id'];
        }

        return $this->doctrine->getRepository(Cocktail::class)->findByIds($cocktailIds);
    }
}