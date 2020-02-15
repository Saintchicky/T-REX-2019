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
        $doctrine_demos = $this->getDoctrine()->getRepository(DoctrineDemo::class)->findAll();
        $doctrine_demo = new DoctrineDemo();
        $form = $this->createForm(DoctrineDemoType::class, $doctrine_demo,[
            'action' => $this->generateUrl('doctrine_add'),
            'method' => 'POST',
        ]);
        return $this->render('doctrine/_doctrine_show.twig', [
            'form' => $form->createView(),
            'doctrine_demos'=>$doctrine_demos,
            'controller_name' => 'DoctrineController',
        ]);
    }
    public function doctrine_add(Request $request)
    {
        $doctrine_demo = new DoctrineDemo();
        // Création du form
        $form = $this->createForm(DoctrineDemoType::class, $doctrine_demo);
        // Pour initialiser les datetimes created at et updated at, il faut mettre un constructor dans L'entité 
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager(); // On récupère l'entity manager
            $em->persist($doctrine_demo); // On confie notre entité à l'entity manager (on persist l'entité)
            $em->flush(); // On execute la requete

                
            $this->addFlash(
                'notice',
                'C\'est sauvegardé'
            );
       

            return $this->redirectToRoute('doctrine_show');
        }
    }
    public function doctrine_edit(DoctrineDemo $doctrine_demo)
    {
        $form = $this->createForm(DoctrineDemoType::class, $doctrine_demo,[
            'action' => $this->generateUrl('doctrine_modify',[
                'id' => $doctrine_demo->getId(),
            ]),
            'method' => 'POST',
        ]);
        return $this->render('doctrine/_doctrine_edit.twig', [
            'form' => $form->createView(),
            'doctrine_demo'=>$doctrine_demo,
            'controller_name' => 'DoctrineController',
        ]);
    }
    public function doctrine_modify(DoctrineDemo $doctrine_demo, Request $request)
    {
       
        $form = $this->createForm(DoctrineDemoType::class, $doctrine_demo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //$doctrine_demo->setLastUpdateDate(new \DateTime());

            
            $em = $this->getDoctrine()->getManager();
            $em->persist($doctrine_demo);
            $em->flush();
            $this->addFlash(
                'notice',
                'Le formulaire a été modifié'
            );
        }

    	return $this->redirectToRoute('doctrine_show');
    }
    public function doctrine_remove($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $doctrine_objet = $entityManager->getRepository(DoctrineDemo::class)->find($id);
        $entityManager->remove($doctrine_objet);
        $entityManager->flush();
        $this->addFlash(
            'notice',
            'La personne a été rétirée'
        );
        return $this->redirectToRoute('doctrine_show');
    }
}
