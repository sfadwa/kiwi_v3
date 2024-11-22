<?php

namespace App\Controller;

use App\Entity\Machine;
use App\Form\MachineType;
use App\Repository\MachineRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

// Define the base route for the MachineController with the prefix '/machine'.
#[Route('/machine')]
class MachineController extends AbstractController
{
    // Define a route for the index action with the URL '/' and the name 'app_machine_index'.
    #[Route('/', name: 'app_machine_index', methods: ['GET'])]
    public function index(MachineRepository $machineRepository): Response
    {
         // Fetch all the machines from the database.
        return $this->render('machine/index.html.twig', [
            'machines' => $machineRepository->findAll(),
        ]);
    }

    // Define a route for the new action with the URL '/new' and the name 'app_machine_new'.
    #[Route('/new', name: 'app_machine_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Create a new machine object.
        $machine = new Machine();
        $form = $this->createForm(MachineType::class, $machine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($machine);
            $entityManager->flush();

            // Redirect the user to the machine index page.
            return $this->redirectToRoute('app_machine_index', [], Response::HTTP_SEE_OTHER);
        }

        // Render the new machine page with the form.
        return $this->render('machine/new.html.twig', [
            'machine' => $machine,
            'form' => $form,
        ]);
    }

     // Define a route for the show action with the URL '/{id}' and the name 'app_machine_show'.
    #[Route('/{id}', name: 'app_machine_show', methods: ['GET'])]
    public function show(Machine $machine): Response
    {
        // Render the machine show page with the machine object.
        return $this->render('machine/show.html.twig', [
            'machine' => $machine,
        ]);
    }

    // Define a route for the edit action with the URL '/{id}/edit' and the name 'app_machine_edit'.
    #[Route('/{id}/edit', name: 'app_machine_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Machine $machine, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(MachineType::class, $machine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_machine_index', [], Response::HTTP_SEE_OTHER);
        }

        // Render the edit machine page with the form
        return $this->render('machine/edit.html.twig', [
            'machine' => $machine,
            'form' => $form,
        ]);
    }

    // Define a route for the delete action with the URL '/{id}' and the name 'app_machine_delete'.
    #[Route('/{id}', name: 'app_machine_delete', methods: ['POST'])]
    public function delete(Request $request, Machine $machine, EntityManagerInterface $entityManager): Response
    {
          // Check if the CSRF token is valid.
        if ($this->isCsrfTokenValid('delete'.$machine->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($machine);
            $entityManager->flush();
        }

        // Redirect the user to the machine index page.
        return $this->redirectToRoute('app_machine_index', [], Response::HTTP_SEE_OTHER);
    }
}
