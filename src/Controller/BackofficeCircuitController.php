<?php

namespace App\Controller;

use App\Entity\Circuit;
use App\Form\EtapeType;
use App\Form\CircuitType;
use App\Repository\CircuitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Etape;
/**
 * @Route("admin/circuit")
 */
class BackofficeCircuitController extends AbstractController
{
    /**
     * @Route("/", name="admin_circuit_index", methods="GET")
     */
    public function index(CircuitRepository $circuitRepository): Response
    {
        return $this->render('back/circuit/index.html.twig', ['circuits' => $circuitRepository->findAll()]);
    }

    /**
     * @Route("/new", name="admin_circuit_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $circuit = new Circuit();
        $form = $this->createForm(CircuitType::class, $circuit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($circuit);
            $em->flush();

            return $this->redirectToRoute('admin_circuit_index');
        }

        return $this->render('back/circuit/new.html.twig', [
            'circuit' => $circuit,
            'form' => $form->createView(),
        ]);
    }

    
    /**
     * @Route("/{id}", name="admin_circuit_show", methods="GET")
     */
    public function show(Circuit $circuit): Response
    {
        return $this->render('back/circuit/show.html.twig', [
            'circuit' => $circuit,
        ]);
        
    }

    /**
     * @Route("/{id}/edit", name="admin_circuit_edit", methods="GET|POST")
     */
    public function edit(Request $request, Circuit $circuit): Response
    {
        $form = $this->createForm(CircuitType::class, $circuit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_circuit_edit', ['id' => $circuit->getId()]);
        }

        return $this->render('back/circuit/edit.html.twig', [
            'circuit' => $circuit,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_circuit_delete", methods="DELETE")
     */
    public function delete(Request $request, Circuit $circuit): Response
    {
        if ($this->isCsrfTokenValid('delete'.$circuit->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($circuit);
            $em->flush();
        }

        return $this->redirectToRoute('admin_circuit_index');
    }
    
    
    /**
     * @Route("/{id}/addetape", name="admin_etape_add", methods="GET|POST")
     */
    public function add(Request $request, Circuit $circuit): Response
    {
        $etape = new Etape();
        $form = $this->createForm(EtapeType::class, $etape);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            //$etape->setCreated(new \DateTime());
            $circuit->addEtape($etape);
            $em = $this->getDoctrine()->getManager();
            $em->persist($etape);
            $em->flush();
            
            $this->get('session')->getFlashBag()->add('message', 'tâche bien ajoutée au projet');
            
            return $this->redirectToRoute('admin_circuit_show', array('id' => $circuit->getId() ));
        }
        
        return $this->render('back/etape/add.html.twig', [
            'circuit' => $circuit,
            'etape' => $etape,
            'form' => $form->createView(),
        ]);
    }
}
