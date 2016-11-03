<?php
namespace Project\AppBundle\Entity;

use Ciklum\DoctrineExtraBundle\Entity\IdentifiableInterface;
use Ciklum\DoctrineExtraBundle\Entity\IdGeneratedTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;
use Project\CoreBundle\Entity\TitleInterface;


/**
 * @ORM\Entity()
 * @ORM\Table(name="ingredient")
 */
class Ingredient implements IdentifiableInterface, TitleInterface
{
    use IdGeneratedTrait, ORMBehaviors\Translatable\Translatable;

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