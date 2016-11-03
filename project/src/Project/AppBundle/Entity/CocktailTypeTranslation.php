<?php
namespace Project\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;
use Project\CoreBundle\Entity\TitleTrait;

/**
 * @ORM\Entity()
 * @ORM\Table(name="cocktail_type_translation")
 */
class CocktailTypeTranslation
{
    use ORMBehaviors\Translatable\Translation, TitleTrait;
}