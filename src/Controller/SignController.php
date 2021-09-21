<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SignController extends AbstractController
{
    /**
     * @Route("/sign", name="sign")
     */
    public function index(): Response
    {
        return $this->redirectToRoute('register');
    }
}
