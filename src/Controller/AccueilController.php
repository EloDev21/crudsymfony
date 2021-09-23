<?php

namespace App\Controller;

use App\Entity\Slider;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function index(): Response
    {
        $imagesSlider = $this->getDoctrine()->getRepository(Slider::class)->findAll();

        return $this->render('accueil/index.html.twig', [
            '$imagesSlider' => $imagesSlider
        ]);
    }
}
