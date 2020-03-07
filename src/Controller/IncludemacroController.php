<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IncludemacroController extends AbstractController
{
    /**
     * @Route("/includemacro", name="includemacro")
     */
    public function index()
    {
        $code_include_var ="
        // Le only est facultatif, Il permet d'indiquer que 
        // le fichier inclus 
        // n'a pas besoin des variables extérieures, 
        // mais seulement ceux passés en paramètres. 
        {% 
            include  'includes/_step.twig' 
            with {step: 'shipping'} only 
        %}
        ";
        $code_include_cond = "
        {% 
            include oav  ? 
            '/includemacro/includes/_adh_form_oav.twig' 
            : 
            '/includemacro/includes/_adh_form.twig' 
        %}
        ";
        return $this->render('includemacro/index.html.twig', [
            'controller_name' => 'IncludemacroController',
            'code_include_var'=>$code_include_var,
            'code_include_cond'=>$code_include_cond
        ]);
    }
}
