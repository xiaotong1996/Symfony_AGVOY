<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Circuit;
use App\Entity\ProgrammationCircuit;



class FrontofficeHomeController extends AbstractController
{

    
    /**
     * @Route("/listCircuit", name="list_circuire")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        $circuits = $em->getRepository(Circuit::class)->findAll();
        
        
        return $this->render('front/circuit_list.html.twig', [
            'circuits' => $circuits,
        ]);
    }
    
    /**
     * @Route("/circuitlist", name="frontoffice_circuitlist")
     */
    public function listproCircuit()
    {
        $em = $this->getDoctrine()->getManager();
        $proCircuits = $em->getRepository(ProgrammationCircuit::class)->findAll();
        
        
        return $this->render('front/home.html.twig', [
            'proCircuits' => $proCircuits,
        ]);
    }
    
  

    
    /**
     * Finds and displays a circuit entity.
     *
     * @Route("/circuit/{id}", name="front_circuit_show",requirements={ "id": "\d+"}, methods="GET")
     */
    public function circuitShow($id)
    {
        $em = $this->getDoctrine()->getManager();
        
        $proCircuit = $em->getRepository(ProgrammationCircuit::class)->find($id);
        
       
        
        return $this->render('front/circuit_show.html.twig', [
            'programmation_circuit' => $proCircuit,
        ]);
    }
    
    
    /**
     * Finds and displays a circuit entity.
     *
     * @Route("/like/{id}", name="front_circuit_like",requirements={ "id": "\d+"}, methods="GET")
     */
    public function circuitLike($id)
    {
        $em = $this->getDoctrine()->getManager();
        
        $proCircuits = $em->getRepository(ProgrammationCircuit::class)->findAll();
        
        $likes=array();
        $likes = $this->get('session')->get('likes');
        

        
        if($likes!=null)
        {
            if (! in_array($id, $likes) )
            {
                $likes[] = $id;
                $this->get('session')->getFlashBag()->add('message', 'bien ajouté');
            }
            else
            // sinon, le retirer du tableau
            {
                $likes = array_diff($likes, array($id));
                $this->get('session')->getFlashBag()->add('message', 'bien supprimé');
            }
            
        }else
        {
            $likes[] = $id;
            $this->get('session')->getFlashBag()->add('message', 'bien ajouté');
        }
        $this->get('session')->set('likes', $likes);
        
        return $this->redirectToRoute('front_circuit_likes');
    }
    

    
    /**
     * Mémorisation et redirection vers liste circuit
     *
     * @Route("/likes", name="front_circuit_likes")
     */
    public function circuitLikes()
    {
        
        $likes = $this->get('session')->get('likes');
        $em = $this->getDoctrine()->getManager();
        $circuitLikes=array();
        if($likes!=null)
        {
            foreach ($likes as $id)
            {
                $circuit = $em->getRepository(ProgrammationCircuit::class)->find($id);
                $circuitLikes[]=$circuit;
            }
        }
        
        /*
        dump($likes);
        $em = $this->getDoctrine()->getManager();
        $proCircuits = $em->getRepository(ProgrammationCircuit::class)->findAll();
        //$circuit=new ProgrammationCircuit();
        $circuitLikes=array();
        
        
        foreach ($proCircuits as $circuit)
        {
            dump($circuit);
            if ( in_array($circuit->getId(), $likes) )
            {
                $circuitLikes[]=$circuit;
            }
        }
        */
        dump($circuitLikes);
        return $this->render('front/likes.html.twig', [
            'proCircuits' => $circuitLikes,
        ]);
    }
    
}
