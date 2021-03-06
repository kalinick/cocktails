<?php
namespace Project\AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;
use PhpSolution\Doctrine\Entity\IdentifiableInterface;
use PhpSolution\Doctrine\Entity\IdGeneratedTrait;
use Project\CoreBundle\Entity\DescriptionInterface;
use Project\CoreBundle\Entity\TitleInterface;

/**
 * @ORM\Entity(repositoryClass="Project\AppBundle\Repository\CocktailRepository")
 * @ORM\Table(name="cocktail")
 */
class Cocktail implements IdentifiableInterface, TitleInterface , DescriptionInterface
{
    use IdGeneratedTrait, ORMBehaviors\Translatable\Translatable;

    /**
     * @ORM\ManyToOne(targetEntity="CocktailType", inversedBy="cocktails")
     * @ORM\JoinColumn(name="type_id", referencedColumnName="id", nullable=false)
     *
     * @var CocktailType
     */
    private $type;

    /**
     * @ORM\OneToMany(targetEntity="CocktailComponent", mappedBy="cocktail", cascade={"persist"}, orphanRemoval=true)
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
     * @return string
     */
    public function getDescription()
    {
        return $this->proxyCurrentLocaleTranslation(__FUNCTION__);
    }

    /**
     * @return CocktailType
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param CocktailType $type
     *
     * @return Cocktail
     */
    public function setType(CocktailType $type): Cocktail
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
     * @return Cocktail
     */
    public function addCocktailComponent(CocktailComponent $cocktailComponent): Cocktail
    {
        $components = $this->getCocktailComponents();
        if (!$components->contains($cocktailComponent)) {
            $cocktailComponent->setCocktail($this);
            $components->add($cocktailComponent);
        }

        return $this;
    }

    /**
     * @param CocktailComponent $cocktailComponent
     *
     * @return Cocktail
     */
    public function removeCocktailComponent(CocktailComponent $cocktailComponent): Cocktail
    {
        $components = $this->getCocktailComponents();
        if ($components->contains($cocktailComponent)) {
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