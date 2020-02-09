<?php

namespace App\Controller;

use App\Entity\Vaisseau;
use App\Entity\Referencement;
use App\Form\VaisseauType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index()
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
    public function vaisseau_index()
    {
        $vaisseaux = $this->getDoctrine()->getRepository(Vaisseau::class)->findAll();
        $vaisseau = new Vaisseau();
        $form = $this->createForm(VaisseauType::class, $vaisseau);
        return $this->render('exemples/_vaisseau.twig', [
            'controller_name' => 'HomeController',
            'form' => $form->createView(),
            'vaisseaux'=>$vaisseaux
        ]);

    }
    public function vaisseau_form(Request $request)
    {
        $vaisseau = new Vaisseau();
        // Création du form
        $form = $this->createForm(VaisseauType::class, $vaisseau);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager(); // On récupère l'entity manager
            $em->persist($vaisseau); // On confie notre entité à l'entity manager (on persist l'entité)
            $em->flush(); // On execute la requete

                
            $this->addFlash(
                'notice',
                'C\'est sauvegardé'
            );
       

            return $this->redirectToRoute('vaisseau_index');
        }
    }
    public function referencement_index()
    {
        $referencements = $this->getDoctrine()->getRepository(Referencement::class)->findAll();
        
        foreach($referencements as $ref){
           $ville = $ref->getVille();
        }   
        $choix = &$ville;
        $var1 = var_dump($choix);

        $ville = "Tokyo";
        return $this->render('exemples/_referencement.twig', [
            'controller_name' => 'HomeController',
            "ville"=>$ville,
            'choix'=>$choix
        ]);
    }
}
