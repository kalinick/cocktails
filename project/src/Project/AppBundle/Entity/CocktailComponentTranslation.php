<?php
namespace Project\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * @ORM\Entity()
 * @ORM\Table(name="cocktail_component_translation")
 */
class CocktailComponentTranslation
{
    use ORMBehaviors\Translatable\Translation;

    /**
     * @ORM\Column(type="string", name="portion", nullable=false)
     *
     * @var string
     */
    private $portion;

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
     * @return $this
     */
    public function setPortion(string $portion)
    {
        $this->portion = $portion;

        return $this;
    }
}