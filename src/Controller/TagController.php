<?php
namespace App\Controller;

use App\Entity\Tag;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

Class TagController extends AbstractController
{
    /**
     * @return Response
     * @Route("/tag", name="tag_index")
     */
    public function index():Response
    {
        $tags = $this->getDoctrine()
            ->getRepository(Tag::class)
            ->findAll();
        if (!$tags) {
            throw $this->createNotFoundException(
                'No article found in article\'s table.'
            );
        }
        return $this->render(
            'Tag/index.html.twig', [
            'tags' => $tags,
        ]);
    }
    /**
     * @param Tag $tag
     * @return Response
     * @Route("/tag/{name}", name="tag_article")
     */
    public function showArticlesByTag(Tag $tag):Response
    {
        $articles = $tag->getArticles();
        return $this->render(
            'Tag/show.html.twig', [
            'articles' => $articles,
            'tags' => $tag
        ]);
    }
    /**
     * Show all row from article's entity
     * @param $request Request
     * @Route("/add", name="tag_add")
     * @return Response A response instance
     */
}