<?php

namespace App\Controller;

use App\Entity\DoctrineDemo;
use App\Form\DoctrineDemoType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DoctrineController extends AbstractController
{
    /**
     * @Route("/doctrine", name="doctrine")
     */
    public function doctrine_index()
    {
        return $this->render('doctrine/_doctrine_index.twig', [
            'controller_name' => 'DoctrineController',
        ]);
    }
    public function doctrine_show()
    {
        $doctrine_demo = new DoctrineDemo();
        $form = $this->createForm(DoctrineDemoType::class, $doctrine_demo);
        return $this->render('doctrine/_doctrine_show.twig', [
            'form' => $form->createView(),
            'controller_name' => 'DoctrineController',
        ]);
    }
    public function doctrine_add(Request $request)
    {
        $doctrine_demo = new DoctrineDemo();
        // Création du form
        $form = $this->createForm(DoctrineDemoType::class, $vaisseau);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager(); // On récupère l'entity manager
            $em->persist($doctrine_demo); // On confie notre entité à l'entity manager (on persist l'entité)
            $em->flush(); // On execute la requete

                
            $this->addFlash(
                'notice',
                'C\'est sauvegardé'
            );
       

            return $this->redirectToRoute('vaisseau_index');
        }
    }
}
