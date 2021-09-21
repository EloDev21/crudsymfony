<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(Request $request): Response
    {
        $contact = new Contact;
        $contact->setCreatedAt(new \DateTime('now'));
        $contact->setSujet('Prise de contact');
        $formContact = $this->createForm(ContactType::class, $contact);
        $formContact->handleRequest($request);
        if($formContact->isSubmitted() && $formContact->isValid())
        {
            $contact->setCreatedAt(new \DateTime());
            // envoi avec swiftmailer
            $contact ->setCreatedAt(new \DateTime());
            $em= $this->getDoctrine()->getManager();
            $em->persist($contact);
            $em->flush();
            $this->addFlash('mail_envoye', 'Votre mail a été envoyé  avec succès!!! ');
            return $this->redirectToRoute('contact');

        }
       

        return $this->render('contact/index.html.twig', [
            'formContact'=> $formContact->createView()
        ]);
    }
}
