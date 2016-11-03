<?php
namespace Project\AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Form\FormMapper;

/**
 * Class CocktailComponentAdmin
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
            ->add('portion')
            ->end();
    }
}