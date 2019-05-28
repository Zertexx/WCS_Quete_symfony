<?php
/**
 * Created by PhpStorm.
 * User: zerto
 * Date: 27/05/2019
 * Time: 15:52
 */

namespace App\Controller;


use App\Entity\Tag;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class TagController extends AbstractController
{
    /**
     * @Route("/tag", name="tags")
     */

    public function index(): Response
    {
        $tags = $this->getDoctrine()
            ->getRepository(Tag::class)
            ->findAll();

        return $this->render('Tag/index.html.twig', [
            'tags' => $tags,
        ]);
    }


    /**
     * @param Tag $tag
     * @return Response
     * @Route("/tag/{name}", name="tag_article")
     */
    public function showByTag(Tag $tag):Response
    {
        $articles = $tag->getArticles();
        return $this->render(
            'blog/tag_article.html.twig', [
            'articles' => $articles,
            'tags' => $tag
        ]);
    }
}