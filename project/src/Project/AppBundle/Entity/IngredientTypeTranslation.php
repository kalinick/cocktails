<?php
namespace Project\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;
use Project\CoreBundle\Entity\TitleTrait;

/**
 * @ORM\Entity()
 * @ORM\Table(name="ingredient_type_translation")
 */
class IngredientTypeTranslation
{
    use ORMBehaviors\Translatable\Translation, TitleTrait;
}