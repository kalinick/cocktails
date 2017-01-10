<?php
namespace Project\AppBundle\Service;

use Ciklum\DoctrineExtraBundle\Utils\DoctrineAwareTrait;
use Project\AppBundle\Entity\Ingredient;

/**
 * Class IngredientService
 */
class IngredientService
{
    use DoctrineAwareTrait;

    /**
     * @return Ingredient[][]
     */
    public function getAllGroupedByType()
    {
        $result = [];
        $all = $this->doctrine->getRepository(Ingredient::class)->findAllOrdered();
        foreach ($all as $ingredient) {
            $typeId = $ingredient->getType()->getId();
            if (!array_key_exists($typeId, $result)) {
                $result[$typeId] = [];
            }
            $result[$typeId][] = $ingredient;
        }

        return $result;
    }
}