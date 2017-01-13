<?php
namespace Project\AppBundle\DataControl;

use Doctrine\ORM\QueryBuilder;
use Project\AppBundle\Entity\Ingredient;
use Project\CoreBundle\DataControl\Behaiviour\ModifyQueryBuilderInterface;
use Project\CoreBundle\DataControl\Collection\DCCollection;
use Project\CoreBundle\DataControl\Html\TemplateInterface;

/**
 * Class DCIngredients
 */
class DCIngredients extends DCCollection implements ModifyQueryBuilderInterface, TemplateInterface
{
    const NAME = 'ingredients';

    /**
     * @var Ingredient[]
     */
    private $ingredients;

    /**
     * @param Ingredient[] $ingredients
     */
    public function __construct(array $ingredients)
    {
        $this->name = self::NAME;
        $this->ingredients = $ingredients;
    }

    /**
     * @param QueryBuilder $qb
     *
     * @return $this
     */
    public function modifyQueryBuilder(QueryBuilder $qb)
    {
        $ingredients = $this->getCollection();
        if (count($ingredients) > 0) {
            $qb
                ->andWhere('cc.ingredient IN (:ingredients)')
                ->setParameter('ingredients', $ingredients);
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getTemplate(): string
    {
        return 'ProjectAppBundle:DataControl:ingredients.html.twig';
    }

    /**
     * @return Ingredient[][]
     */
    public function getGrouped()
    {
        $result = [];
        foreach ($this->ingredients as $ingredient) {
            $typeId = $ingredient->getType()->getId();
            if (!array_key_exists($typeId, $result)) {
                $result[$typeId] = [];
            }
            $result[$typeId][] = $ingredient;
        }

        return $result;
    }
}