<?php
/**
 * Created by PhpStorm.
 * User: zerto
 * Date: 11/05/2019
 * Time: 11:49
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController extends AbstractController
{
    public function index()
    {

        /**
         * @Route("/default/index")
         */

        return $this->render('/default.html.twig');

    }

}