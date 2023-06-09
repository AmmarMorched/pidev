<?php

namespace App\Controller;

use App\Entity\Circuit;
use App\Form\CircuitType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/circuit')]
class CircuitController extends AbstractController
{
    #[Route('/', name: 'app_circuit_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $circuits = $entityManager
            ->getRepository(Circuit::class)
            ->findAll();

        return $this->render('circuit/index.html.twig', [
            'circuits' => $circuits,
        ]);
    }

    #[Route('/new', name: 'app_circuit_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $circuit = new Circuit();
        $form = $this->createForm(CircuitType::class, $circuit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($circuit);
            $entityManager->flush();

            return $this->redirectToRoute('app_circuit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('circuit/new.html.twig', [
            'circuit' => $circuit,
            'form' => $form,
        ]);
    }

    #[Route('/{nc}', name: 'app_circuit_show', methods: ['GET'])]
    public function show(Circuit $circuit): Response
    {
        return $this->render('circuit/show.html.twig', [
            'circuit' => $circuit,
        ]);
    }

    #[Route('/{nc}/edit', name: 'app_circuit_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Circuit $circuit, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CircuitType::class, $circuit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_circuit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('circuit/edit.html.twig', [
            'circuit' => $circuit,
            'form' => $form,
        ]);
    }

    #[Route('/{nc}', name: 'app_circuit_delete', methods: ['POST'])]
    public function delete(Request $request, Circuit $circuit, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$circuit->getNc(), $request->request->get('_token'))) {
            $entityManager->remove($circuit);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_circuit_index', [], Response::HTTP_SEE_OTHER);
    }
}
