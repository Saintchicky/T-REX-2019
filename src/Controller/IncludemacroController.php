<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

class IncludemacroController extends AbstractController
{
    /**
     * @Route("/includemacro", name="includemacro")
     */
    public function index(Request $request)
    {
        $step = 'shipping';
        $oav = false;
        $session = new Session();
        
        if ($request->isMethod('POST') && $request->get('step') != "") {
            $step_post = $request->get('step');
            $session->set('step', $step_post);
            $step = $session->get('step');
        }
        if ($request->isMethod('POST') && $request->get('oav') == "true") {
            $oav_post = $request->get('oav');
            $session->set('oav', $oav_post);
            $oav = $session->get('oav');
        }
       
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
            'code_include_cond'=>$code_include_cond,
            'step'=>$step,
            'oav'=>$oav,
        ]);
    }
}
