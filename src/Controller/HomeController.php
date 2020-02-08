<?php

namespace App\Controller;

use App\Entity\Vaisseau;
use App\Form\VaisseauType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

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
    public function vaisseau()
    {
        $vaisseau = new Vaisseau();
        // Création du form
        $form = $this->createForm(VaisseauType::class, $vaisseau);

    	return $this->render('exemples/_vaisseau.twig', [
            'controller_name' => 'HomeController',
            'form' => $form->createView()
        ]);
    }
}
