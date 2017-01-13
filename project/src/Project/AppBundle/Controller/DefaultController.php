<?php
namespace Project\AppBundle\Controller;

use Project\AppBundle\DataControl\DCIngredients;
use Project\AppBundle\Entity\CocktailComponent;
use Project\AppBundle\Entity\Ingredient;
use Project\CoreBundle\DataControl\Base\DCContainer;
use Project\CoreBundle\DataControl\Paginator\HtmlPaginator;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * DefaultController
 */
class DefaultController extends Controller
{
    /**
     * @param Request $request
     *
     * @return Response
     */
    public function indexAction(Request $request)
    {
        $dcContainer = (new DCContainer())
            ->add(new DCIngredients($this->getDoctrine()->getRepository(Ingredient::class)->findAllOrdered()))
            ->bindRequest($request);

        $total = $this->getDoctrine()->getRepository(CocktailComponent::class)->countCocktails($dcContainer);
        $dcContainer->add((new HtmlPaginator($total))
            ->bindRequest($request));

        return $this->render('ProjectAppBundle:Default:index.html.twig', [
            'dcContainer' => $dcContainer,
            'cocktails' => $this->get('project_app.service.cocktail_finder')->find($dcContainer)
        ]);
    }
}