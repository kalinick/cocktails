<?php
namespace Project\AppBundle\Service;

use Ciklum\DoctrineExtraBundle\Utils\DoctrineAwareTrait;
use Project\AppBundle\DataControl\DCIngredients;
use Project\AppBundle\Entity\Cocktail;
use Project\AppBundle\Entity\CocktailComponent;
use Project\CoreBundle\DataControl\Base\DataControl;
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
        if (empty($dcIngredient->getCollection())) {
            return $this->doctrine->getRepository(Cocktail::class)->findByDC($dcc);
        }

        $cocktailIds = [];
        $list = $this->doctrine->getRepository(CocktailComponent::class)->findMostSuitable($dcc);
        foreach ($list as $row) {
            $cocktailIds[] = $row['cocktail_id'];
        }

        return $this->doctrine->getRepository(Cocktail::class)->findByIds($cocktailIds);
    }
}