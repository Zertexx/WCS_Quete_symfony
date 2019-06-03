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
     * @Route("/category/list", name="category_index")
     * @return Response A response instance
     */

    public function index(): Response
    {
        $categories = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findAll();
        return $this->render('Blog/list.html.twig', [
            'categories' => $categories
        ]);
    }

    /**
     * Show all row from article's entity
     * @param $request Request
     * @Route("/category/add", name="category_add")
     * @return Response A response instance
     */

    public function add(Request $request): Response
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($category);
            $entityManager->flush();
            return $this->redirectToRoute('category_index');
        }
        return $this->render('Blog/form.html.twig', ['form' => $form->createView()]);

    }

    /**
     * @Route("/category/{slug<^[a-z0-9-]+$>}", name="category_show")
     * @return Response
     */

    public function showByCategory(Category $category): Response
    {

        $articles = $category->getArticles();

        return $this->render(
            'blog/category.html.twig',
            [
                'category' => $category,
                'articles' => $articles,

            ]
        );

    }
}