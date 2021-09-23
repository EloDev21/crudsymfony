<?php

namespace App\Controller;

use App\Entity\Circuits;
use App\Form\CircuitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CircuitsController extends AbstractController
{
    /**
     * @Route("/circuits", name="circuits")
     */
    public function index(): Response
    {
        // affichage de tous les circuits
        $circuits = $this->getDoctrine()->getRepository(Circuits::class)->findAll();
        return $this->render('circuits/index.html.twig', [
            'allCircuits' => $circuits
        ]);
    }

    /**
     * @Route("/circuits/{slug}-{id}", name="circuits.detail", requirements={"slug": "[a-z0-9\-]*"})
     */
    public function detail($slug,$id): Response
    {
        $circuit = $this->getDoctrine()->getRepository(Circuits::class)->find($id);
        return $this->render('circuits/detail.html.twig', [
            'circuit' =>$circuit,
            'allCircuits' => 'circuits'
        ]);
    }
    /**
     * @Route("/circuits/add", name="circuits_add")
     */
    public function add(Request $request)
    {
        
        $circuit = new Circuits();
        $formCircuit=$this->createForm(CircuitType::class,$circuit);
        $formCircuit->handleRequest($request);
        if($formCircuit->isSubmitted() && $formCircuit->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($circuit);
            $em->flush();
            $this->addFlash('circuit_added', 'Votre circuit a été ajouté avec succès!!! ');
            return $this->redirectToRoute('circuits');
     
        }

      return $this->render(('circuits/form-add.html.twig'),[
          'formCircuit'=>$formCircuit->createView()
      ]);    
            
    
}
    /**
     * @Route("/circuits/edit/{id}", name="circuits_edit")
     */
    public function edit(Request $request, $id)
    {

        $circuit = $this->getDoctrine()->getRepository(Circuits::class)->find($id);
        $circuit->setCreatedAt= new \DateTime();
        $circuit->setUpdatedAt= new \DateTime();

        $formCircuit = $this->createForm(CircuitType::class, $circuit);
        $formCircuit->handleRequest($request);
        if ($formCircuit->isSubmitted() && $formCircuit->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $circuit->setCreatedAt(new \DateTime());
            $em->flush();
            $this->addFlash('circuit_edited', 'Le circuit a été modifié avec succès!!! ');
            return $this->redirectToRoute('circuits');
        }
        return $this->render('circuits/form-edit.html.twig', [
            'formCircuit' => $formCircuit->createView()
        ]);
    }

    /**
     * @Route("/circuits/delete/{id}", name="circuits_delete")
     */
    public function delete($id)
    {
        $circuit = $this->getDoctrine()->getRepository(Circuits::class)->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($circuit);
        $em->flush();
        $this->addFlash('circuit_deleted', 'Circuit supprimé avec succès!!! ');
        return $this->redirectToRoute('circuits');
    }
}
