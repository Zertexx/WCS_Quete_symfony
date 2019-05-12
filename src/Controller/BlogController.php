<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class BlogController extends AbstractController
{

    /**
     * @Route("/blog/show/{slug<[a-z-0-9-]+>}", name="blog_show")
     */



    public function show( $slug = 'Article Sans Titre')
    {
        $slug = ucwords(str_replace("-", " ", $slug));
        return $this->render('Blog/show.html.twig', [
            'slug' => $slug,
        ]);
    }
}