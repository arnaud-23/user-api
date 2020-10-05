<?php

declare(strict_types=1);

namespace App\Controller\Web;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class WebAppController extends AbstractController
{
    /** @Route("/", name="web_app_home", methods={"GET"}) */
    public function home(): Response
    {
        return $this->render('web/web_app/index.html.twig');
    }

    /** @Route("/{path}", name="web_app", methods={"GET"}) */
    public function index(string $path): Response
    {
        return $this->render('web/web_app/index.html.twig');
    }
}
