<?php
namespace Project\AppBundle\Controller;

use Project\AppBundle\Entity\Cocktail;
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
        return $this->render('ProjectAppBundle:Default:index.html.twig', [
            'selectedIngredients' => $request->get('ingredients'),
            'ingredients' => $this->get('project_app.service.ingredient')->getAllGroupedByType(),
            'cocktails' => $this->get('project_app.service.cocktail_finder')->find($request->get('ingredients'))
        ]);
    }
}