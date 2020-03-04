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
    public function vaisseau_form(Request $request)
    {
        $vaisseaux = $this->getDoctrine()->getRepository(Vaisseau::class)->findAll();
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
       

            return $this->redirectToRoute('vaisseau_form');
        }
        return $this->render('exemples/_vaisseau.twig', [
            'controller_name' => 'HomeController',
            'form' => $form->createView(),
            'vaisseaux'=>$vaisseaux
        ]);

    }
    public function referencement_index()
    {
        $referencements = $this->getDoctrine()->getRepository(Referencement::class)->findAll();
        
        foreach($referencements as $ref){
           $ville = $ref->getVille();
        }   
        $choix = &$ville;


        $ville = "Tokyo";

        $choix = "Mexico";
        $ville = "Paris";


        // Create a new instance of Highlighter
        // $highlighter = new Highlighter();
        // Define the language that you want to use to highlight
        $language = "php";

        $code = '
        // Appel de Doctrine pour récupérer les objets
        $referencements = $this->getDoctrine()
        ->getRepository(Referencement::class)->findAll();

        foreach($referencements as $ref){
            $ville = $ref->getVille();
        } 

        $choix = &$ville;

        $ville = "Tokyo";

        $choix = "Mexico";
        $ville = "Paris";
        ';
    
        return $this->render('exemples/_referencement.twig', [
            'controller_name' => 'HomeController',
            "ville"=>$ville,
            'choix'=>$choix,
            'code'=>$code
        ]);
    }
    public function console_bin_index()
    {
        return $this->render('exemples/_console_bin.twig', [
            'controller_name' => 'HomeController'
        ]);
    }
    public function extract_map_index()
    {
        // Extract 
        $tab =  ['adh'=>'Léopold Maltret','d_code'=>'d896654543','nb_enfants'=>'3'];
        extract($tab);

        $code_extract = '
        // Extract
        $tab =  [
        "adh"=>"Léopold Maltret",
        "d_code"=>"d896654543","nb_enfants"=>"3"
        ];
        extract($tab);
        ';

        // Array_map
        $a = [1, 2, 3, 4, 5];
        $b = array_map(function($n)
        {
            return ($n * $n * $n);
        }, $a);

        $code_array = '
        // Array_map
        $a = [1, 2, 3, 4, 5];
        $b = array_map(function($n)
        {
            return ($n * $n * $n);
        }, $a);
        ';

        return $this->render('exemples/_extract_map.twig', [
            'adh'=>$adh,
            'd_code'=>$d_code,
            'nb_enfants'=>$nb_enfants,
            'code_array'=>$code_array,
            'code_extract'=>$code_extract,
            'b'=>$b,
            'controller_name' => 'HomeController'
        ]);
    }
    public function twig()
    {
        return $this->render('exemples/_twig.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
