<?php
namespace Project\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;
use PhpSolution\Doctrine\Entity\IdentifiableInterface;
use PhpSolution\Doctrine\Entity\IdGeneratedTrait;

/**
 * @ORM\Entity(repositoryClass="Project\AppBundle\Repository\CocktailComponentRepository")
 * @ORM\Table(name="cocktail_component")
 */
class CocktailComponent implements IdentifiableInterface
{
    use IdGeneratedTrait, ORMBehaviors\Translatable\Translatable;

    /**
     * @ORM\ManyToOne(targetEntity="Cocktail", inversedBy="cocktailComponents")
     * @ORM\JoinColumn(name="cocktail_id", referencedColumnName="id", nullable=false)
     *
     * @var Cocktail
     */
    private $cocktail;

    /**
     * @ORM\ManyToOne(targetEntity="Ingredient", inversedBy="cocktailComponents")
     * @ORM\JoinColumn(name="ingredient_id", referencedColumnName="id", nullable=false)
     *
     * @var Ingredient
     */
    private $ingredient;

    /**
     * @return Cocktail
     */
    public function getCocktail()
    {
        return $this->cocktail;
    }

    /**
     * @param Cocktail $cocktail
     *
     * @return CocktailComponent
     */
    public function setCocktail(Cocktail $cocktail): CocktailComponent
    {
        $this->cocktail = $cocktail;

        return $this;
    }

    /**
     * @return Ingredient
     */
    public function getIngredient()
    {
        return $this->ingredient;
    }

    /**
     * @param Ingredient $ingredient
     *
     * @return CocktailComponent
     */
    public function setIngredient(Ingredient $ingredient): CocktailComponent
    {
        $this->ingredient = $ingredient;

        return $this;
    }

    /**
     * @return string
     */
    public function getPortion()
    {
        return $this->proxyCurrentLocaleTranslation(__FUNCTION__);
    }
}