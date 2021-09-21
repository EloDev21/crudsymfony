<?php

namespace App\Controller;
use App\Entity\Circuits;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DetailController extends AbstractController
{
    /**
     * @Route("/detail/{id}", name="detail")
     */
    public function index( Request $request ,$id): Response
    {
        $details =$this->getDoctrine()->getRepository(Circuits::class)->find($id);
        return $this->render('detail/index.html.twig', [
            'details' => $details,
        ]);
    }
}
