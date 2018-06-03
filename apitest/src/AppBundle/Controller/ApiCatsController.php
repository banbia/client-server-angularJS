<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest; // alias pour toutes les annotations
use AppBundle\Entity\Category;

class ApiCatsController extends Controller
{
    /**
     * @Rest\View()
     * @Rest\Get("/categories")
     */
    public function getCategoriesAction(Request $request)
    {

        $cats = $this->get('doctrine.orm.entity_manager')
            ->getRepository('AppBundle:Category')
            ->findAll();
        /* @var $cats Category[] */

        return $cats;
    }

    /**
     * @Rest\View()
     * @Rest\Get("/categories/{id}")
     */
    public function getCategoryAction(Request $request)
    {
        $cat = $this->get('doctrine.orm.entity_manager')
            ->getRepository('AppBundle:Category')
            ->find($request->get('id')); // L'identifiant en tant que paramétre n'est plus nécessaire
        /* @var $cat Category */

        if (empty($cat)) {
            return new JsonResponse(['message' => 'Category not found'], Response::HTTP_NOT_FOUND);
        }

        return $cat;
    }
    /**
     * @Rest\View()
     * @Rest\Get("/posts")
     */
    public function getPostsAction(Request $request)
    {

        $posts = $this->get('doctrine.orm.entity_manager')
            ->getRepository('AppBundle:Post')
            ->findAll();
        /* @var $posts Post[] */

        return $posts;
    }
    /**
     * @Rest\View()
     * @Rest\Get("/postsByCat/{id}")
     */
    public function getPostsByCatAction(Request $request,$id)
    {

        $posts = $this->get('doctrine.orm.entity_manager')
            ->getRepository('AppBundle:Post')
            ->findBy(array('category'=>$id));
        /* @var $posts Post[] */

        return $posts;
    }
}
