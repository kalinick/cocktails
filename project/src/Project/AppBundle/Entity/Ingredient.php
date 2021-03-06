<?php
namespace Project\AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;
use PhpSolution\Doctrine\Entity\IdentifiableInterface;
use PhpSolution\Doctrine\Entity\IdGeneratedTrait;
use Project\CoreBundle\Entity\TitleInterface;


/**
 * @ORM\Entity(repositoryClass="Project\AppBundle\Repository\IngredientRepository")
 * @ORM\Table(name="ingredient")
 */
class Ingredient implements IdentifiableInterface, TitleInterface
{
    use IdGeneratedTrait, ORMBehaviors\Translatable\Translatable;

    /**
     * @ORM\ManyToOne(targetEntity="IngredientType", inversedBy="ingredients")
     * @ORM\JoinColumn(name="type_id", referencedColumnName="id", nullable=false)
     *
     * @var IngredientType
     */
    private $type;

    /**
     * @ORM\OneToMany(targetEntity="CocktailComponent", mappedBy="ingredient")
     *
     * @var Collection|CocktailComponent[]
     */
    private $cocktailComponents;

    /**
     * CocktailType constructor.
     */
    public function __construct()
    {
        $this->cocktailComponents = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->proxyCurrentLocaleTranslation(__FUNCTION__);
    }

    /**
     * @return IngredientType
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param IngredientType $type
     *
     * @return Ingredient
     */
    public function setType(IngredientType $type): Ingredient
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection|CocktailComponent[]
     */
    public function getCocktailComponents()
    {
        return $this->cocktailComponents;
    }

    /**
     * @param CocktailComponent $cocktailComponent
     *
     * @return Ingredient
     */
    public function addCocktailComponent(CocktailComponent $cocktailComponent): Ingredient
    {
        $components = $this->getCocktailComponents();
        if (!$components->contains($cocktailComponent)) {
            $cocktailComponent->setIngredient($this);
            $components->add($cocktailComponent);
        }

        return $this;
    }

    /**
     * @param CocktailComponent $cocktailComponent
     *
     * @return Ingredient
     */
    public function removeCocktailComponent(CocktailComponent $cocktailComponent): Ingredient
    {
        $components = $this->getCocktailComponents();
        if (!$components->contains($cocktailComponent)) {
            $components->removeElement($cocktailComponent);
        }

        return $this;
    }

    /**
     * @return string
     */
    function __toString()
    {
        return $this->getTitle();
    }
}