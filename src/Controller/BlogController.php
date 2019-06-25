<?php


namespace App\Controller;


use App\Entity\Category;
use App\Form\ArticleSearchType;
use App\Form\CategoryType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


/** @Route("/blog", name="blog_") */

class BlogController extends AbstractController
{

    /**
     * Show all row from article's entity
     *
     * @Route("/", name="index")
     * @param SessionInterface $session
     * @return Response A response instance
     */

    public function index(SessionInterface $session): Response
    {

        if (!$session->has('total')) {
            $session->set('total', 120); // if total doesn’t exist in session, it is initialized.
        }

        $total = $session->get('total'); // get actual value in session with ‘total' key.
  // ...

        return $this->render(
            'Blog/index.html.twig'
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
     * @return Response A response instance
     */

    public function show(?string $slug): Response
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
}