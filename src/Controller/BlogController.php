<?php


namespace App\Controller;


use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;

/** @Route("/blog", name="blog_") */

class BlogController extends AbstractController
{

    /**
     * Show all row from article's entity
     *
     * @Route("/", name="index")
     * @return Response A response instance
     */

    public function index(): Response
    {
        $articles = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findAll();

        if (!$articles) {
            throw $this->createNotFoundException(
                'No article found in article\'s table.'
            );
        }

        return $this->render(
            'Blog/index.html.twig',
            ['articles' => $articles]
        );
    }

    /**
     * Getting a article with a formatted slug for title
     *
     * @param string $slug The slugger
     *
     * @Route("/show/{slug<^[a-z0-9-]+$>}",
     *     defaults={"slug" = null},
     *     name="show")
     *  @return Response A response instance
     */

    public function show(?string $slug) : Response
    {

        if (!$slug) {
            throw $this
                ->createNotFoundException('No slug has been sent to find an article in article\'s table.');
        }

        $slug = preg_replace(
            '/-/',
            ' ', ucwords(trim(strip_tags($slug)), "-")
        );



        return $this->render(
            'blog/show.html.twig',
            [
                'slug' => $slug,
            ]
        );
    }

    /**
     *  @Route("/category/{category}", name="show_category")
     */

    public function  showByCategory(string $category='javascript'): Response
    {
        $category = $this->getDoctrine()->getRepository(Category::class)->findOneByName($category);

        $articles = $this->getDoctrine()->getRepository(Article::class)
            ->findBy(['category' => $category], ['id' => 'DESC'], 3);

        return $this->render(
            'blog/category.html.twig',
            [
                'category' => $category,
                'articles' => $articles,

            ]
        );

    }
}