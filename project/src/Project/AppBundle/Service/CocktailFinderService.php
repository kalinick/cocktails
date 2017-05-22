<?php
namespace Project\AppBundle\Service;

use PhpSolution\Doctrine\Aware\DoctrineAwareTrait;
use Project\AppBundle\DataControl\DCIngredients;
use Project\AppBundle\Entity\Cocktail;
use Project\AppBundle\Entity\CocktailComponent;
use Project\CoreBundle\DataControl\Base\DCContainer;

/**
 * CocktailFinderService
 */
class CocktailFinderService
{
    use DoctrineAwareTrait;

    /**
     * @param DCContainer $dcc
     *
     * @return Cocktail[]
     */
    public function find(DCContainer $dcc)
    {
        /* @var DCIngredients $dcIngredient*/
        $dcIngredient = $dcc->get(DCIngredients::NAME);
        $emptyCollection = empty($dcIngredient->getCollection());
        $emptyCollection ?
            $list = $this->doctrine->getRepository(Cocktail::class)->findByDC($dcc) :
            $list = $this->doctrine->getRepository(CocktailComponent::class)->findMostSuitable($dcc);

        $cocktailIds = [];
        foreach ($list as $row) {
            $cocktailIds[] = $emptyCollection ? $row->getId() : $row['cocktail_id'];
        }

        return $this->doctrine->getRepository(Cocktail::class)->findByIds($cocktailIds);
    }
}