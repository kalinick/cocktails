<?php
namespace Project\AppBundle\Admin;

use A2lix\TranslationFormBundle\Form\Type\TranslationsType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

/**
 * Class CocktailAdmin
 */
class CocktailAdmin extends AbstractAdmin
{
    /**
     * {@inheritdoc}
     */
    public function configureListFields(ListMapper $list)
    {
        $list
            ->addIdentifier('id');
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
            ->with('Components')
            ->add('cocktailComponents', 'sonata_type_collection',  [
                'required' => false,
                'by_reference' => false,
            ],[
                'edit' => 'inline',
                'inline' => 'table',
            ]);
    }
}