<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

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
}
