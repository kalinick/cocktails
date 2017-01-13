<?php
namespace Project\AppBundle\Admin;

use A2lix\TranslationFormBundle\Form\Type\TranslationsType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

/**
 * CocktailAdmin
 */
class CocktailAdmin extends AbstractAdmin
{
    /**
     * {@inheritdoc}
     */
    public function configureListFields(ListMapper $list)
    {
        $list
            ->addIdentifier('title')
            ->addIdentifier('description');
    }

    /**
     * {@inheritdoc}
     */
    public function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('translations', TranslationsType::class)
            ->add('type')
            ->end();

        $formMapper
            ->with('project_app.admin.components')
            ->add('cocktailComponents', 'sonata_type_collection',  [
                'label' => false,
                'required' => false,
                'by_reference' => false,
            ],[
                'edit' => 'inline',
                'inline' => 'table',
            ]);
    }
}