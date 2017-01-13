<?php
namespace Project\AppBundle\Admin;

use A2lix\TranslationFormBundle\Form\Type\TranslationsType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Form\FormMapper;

/**
 * CocktailComponentAdmin
 */
class CocktailComponentAdmin extends AbstractAdmin
{
    /**
     * {@inheritdoc}
     */
    public function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('ingredient')
            ->add('translations', TranslationsType::class)
            ->end();
    }
}