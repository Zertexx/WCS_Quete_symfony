<?php
/**
 * Created by PhpStorm.
 * User: zerto
 * Date: 20/05/2019
 * Time: 17:14
 */

namespace App\Controller;


use App\Entity\Category;
use App\Form\CategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class CategoryController extends AbstractController
{
    /**
     * Show all row from article's entity
     *@param $request Request
     * @Route("/category/add", name="category_add")
     * @return Response A response instance
     */

    public function add(Request $request) : Response
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($category);
            $entityManager->flush();
            return $this->redirectToRoute('category');
        }
        return $this->render('Blog/form.html.twig', ['form' => $form->createView()]);

    }

    /**
     * Show all row from article's entity
     * @Route("/category", name="category")
     * @return Response A response instance
     */

    public function show():Response
    {
        $categories = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findAll();
        return $this->render('Blog/list.html.twig', [
            'categories' => $categories
        ]);
    }

}