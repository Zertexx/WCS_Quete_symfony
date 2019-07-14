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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route({
 *     "fr": "categorie",
 *     "en": "category",
 *     "es": "categoria",})
 * @Security("is_granted('ROLE_ADMIN') or is_granted('ROLE_AUTHOR')")
 */

class CategoryController extends AbstractController
{

    /**
     * Show all row from article's entity
     * @Route({
     *     "fr": "/liste",
     *     "en": "/list",
     *     "es": "/lista",
     * }, name="category_index")
     * @return Response A response instance
     */

    public function index(): Response
    {
        $categories = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findAll();
        return $this->render('category/list.html.twig', [
            'categories' => $categories
        ]);
    }

    /**
     * Show all row from article's entity
     * @param $request Request
     * @IsGranted("ROLE_ADMIN")
     * @Route({
     *     "fr": "/ajout",
     *     "en": "/new",
     *     "es": "/crear",
     * }, name="category_add")
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

            $this->addFlash('success', 'Ajout enregistré');

            return $this->redirectToRoute('category_index');
        }
        return $this->render('category/form.html.twig', ['form' => $form->createView()]);

    }

    /**
     * @Route("/{slug<^[a-z0-9-]+$>}", name="category_show")
     * @return Response
     */

    public function showByCategory(Category $category): Response
    {

        $articles = $category->getArticles();

        return $this->render(
            'category/category.html.twig',
            [
                'category' => $category,
                'articles' => $articles,

            ]
        );

    }
}