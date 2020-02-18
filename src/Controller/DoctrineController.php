<?php

namespace App\Controller;

use App\Entity\FormulaireDemo;
use App\Entity\DoctrineDemo;
use App\Form\FormulaireDemoType;
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
    public function doctrine_add(Request $request)
    {
        $formulaire_demos = $this->getDoctrine()->getRepository(FormulaireDemo::class)->findAll();
        $formulaire_demo = new FormulaireDemo();
        $form = $this->createForm(FormulaireDemoType::class, $formulaire_demo,[
            'action' => $this->generateUrl('doctrine_add'),
            'method' => 'POST',
        ]);
        $doctrine_demo = new DoctrineDemo();
        $form_couple =$this->createForm(DoctrineDemoType::class, $doctrine_demo,[
            'action' => $this->generateUrl('doctrine_add'),
            'method' => 'POST',
        ]);
        // if($form_couple->isSubmitted() && $form_couple->isValid()){
        //     $em = $this->getDoctrine()->getManager();
        //     $em->persist($doctrine_demo);
        //     $em->flush();
        // }
        //On retient la requête
    
        
        $form->handleRequest($request);
        if($form->get('couple')->getData()){
            $form_couple->handleRequest($request);
        }
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager(); // On récupère l'entity manager
            $em->persist($formulaire_demo); // On confie notre entité à l'entity manager (on persist l'entité)
             // On confie notre entité à l'entity manager (on persist l'entité)
             // On execute la requete
             $em->flush();
           
            $this->addFlash(
                'notice',
                'C\'est sauvegardé'
            );
            return $this->redirectToRoute('doctrine_add');
        }
        return $this->render('doctrine/_doctrine_show.twig', [
            'form' => $form->createView(),
            'form_couple' => $form_couple->createView(),
            'formulaire_demos'=>$formulaire_demos,
            'controller_name' => 'DoctrineController',
        ]);
    }
    public function doctrine_edit(FormulaireDemo $formulaire_demo)
    {
        $form = $this->createForm(FormulaireDemoType::class, $formulaire_demo,[
            'action' => $this->generateUrl('doctrine_modify',[
                'id' => $formulaire_demo->getId(),
            ]),
            'method' => 'POST',
        ]);
        return $this->render('doctrine/_doctrine_edit.twig', [
            'form' => $form->createView(),
            'formulaire_demo'=>$formulaire_demo,
            'controller_name' => 'DoctrineController',
        ]);
    }
    public function doctrine_modify(FormulaireDemo $formulaire_demo, Request $request)
    {
       
        $form = $this->createForm(FormulaireDemoType::class, $formulaire_demo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Mettre à jour la date si modification
            $formulaire_demo->setUpdatedAt(new \DateTime());
            // When you make flush(), Doctrine checks all the fields of all fetched data and make a transaction to the database.
            $em = $this->getDoctrine()->getManager();
            $em->persist($formulaire_demo);
            $em->flush();
            $this->addFlash(
                'notice',
                'Le formulaire a été modifié'
            );
        }

    	return $this->redirectToRoute('doctrine_add');
    }
    public function doctrine_remove($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        // recherche par Id
        $doctrine_objet = $entityManager->getRepository(FormulaireDemo::class)->find($id);
        // Supprime l'objet appelé
        $entityManager->remove($doctrine_objet);
        $entityManager->flush();
        $this->addFlash(
            'notice',
            'La personne a été rétirée'
        );
        return $this->redirectToRoute('doctrine_add');
    }
}
