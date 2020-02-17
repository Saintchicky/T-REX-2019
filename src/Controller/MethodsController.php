<?php

namespace App\Controller;

use App\Form\MethodsType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MethodsController extends AbstractController
{
    /**
     * @Route("/methods", name="methods")
     */
    public function index()
    {
        return $this->render('methods/index.html.twig', [
            'controller_name' => 'MethodsController',
        ]);
    }

    public function methods()
    {
        return $this->render('methods/_methods_index.twig', [
            'controller_name' => 'MethodsController',
        ]);
    }
}
