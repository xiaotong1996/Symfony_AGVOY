<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Circuit;
use App\Entity\ProgrammationCircuit;


/**
 * @Route("admin")
 */
class BackofficeHomeController extends AbstractController
{

    /**
     * @Route("/", name = "backoffice", methods="GET")
     */
    public function indexAction()
    {
        return $this->render('back/backofficehome.html.twig',array(
            'welcome' => "C'est le backoffice")
            );
    }
       
}
