<?php

declare(strict_types=1);

namespace App\Controller\Web\Security;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="app_register", methods={"GET"})
     */
    public function register(): Response
    {
        return $this->render('web/security/registration.html.twig');
    }
}
