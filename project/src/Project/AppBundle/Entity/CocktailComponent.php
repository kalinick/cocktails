<?php
namespace Project\AppBundle\Entity;

use Ciklum\DoctrineExtraBundle\Entity\IdentifiableInterface;
use Ciklum\DoctrineExtraBundle\Entity\IdGeneratedTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="cocktail_component")
 */
class CocktailComponent implements IdentifiableInterface
{
    use IdGeneratedTrait;

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
     * @ORM\Column(type="string", name="portion", nullable=false)
     *
     * @var string
     */
    private $portion;

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
        return $this->portion;
    }

    /**
     * @param string $portion
     *
     * @return CocktailComponent
     */
    public function setPortion(string $portion): CocktailComponent
    {
        $this->portion = $portion;

        return $this;
    }
}