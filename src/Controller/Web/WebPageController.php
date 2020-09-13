<?php

declare(strict_types=1);

namespace App\Controller\Web;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class WebPageController extends AbstractController
{
    /** @Route("/", name="web_homepage", methods={"GET"}) */
    public function homepage(): Response
    {
        return $this->render('web/homepage.html.twig');
    }
}
