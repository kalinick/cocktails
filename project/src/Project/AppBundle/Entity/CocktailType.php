<?php
namespace Project\AppBundle\Entity;

use Ciklum\DoctrineExtraBundle\Entity\IdDirectoryDataTrait;
use Ciklum\DoctrineExtraBundle\Entity\IdentifiableInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;
use Project\CoreBundle\Entity\TitleInterface;

/**
 * @ORM\Entity()
 * @ORM\Table(name="cocktail_type")
 */
class CocktailType implements IdentifiableInterface, TitleInterface
{
    use IdDirectoryDataTrait, ORMBehaviors\Translatable\Translatable;

    /**
     * @ORM\OneToMany(targetEntity="Cocktail", mappedBy="type")
     *
     * @var Collection|Cocktail[]
     */
    private $cocktails;

    /**
     * CocktailType constructor.
     */
    public function __construct()
    {
        $this->cocktails = new ArrayCollection();
    }

    /**
     * @return Collection|Cocktail[]
     */
    public function getCompanyRelationships()
    {
        return $this->cocktails;
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