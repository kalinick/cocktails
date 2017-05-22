<?php
namespace Project\AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;
use PhpSolution\Doctrine\Entity\IdDirectoryDataTrait;
use PhpSolution\Doctrine\Entity\IdentifiableInterface;
use Project\CoreBundle\Entity\TitleInterface;

/**
 * @ORM\Entity()
 * @ORM\Table(name="ingredient_type")
 */
class IngredientType implements IdentifiableInterface, TitleInterface
{
    use IdDirectoryDataTrait, ORMBehaviors\Translatable\Translatable;

    /**
     * @ORM\OneToMany(targetEntity="Ingredient", mappedBy="type")
     *
     * @var Collection|Ingredient[]
     */
    private $ingredients;

    /**
     * CocktailType constructor.
     */
    public function __construct()
    {
        $this->ingredients = new ArrayCollection();
    }

    /**
     * @return Collection|Ingredient[]
     */
    public function getIngredients()
    {
        return $this->ingredients;
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
    function __toString()
    {
        return $this->getTitle();
    }
}