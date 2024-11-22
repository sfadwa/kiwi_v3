<?php

namespace App\Controller;

use App\Entity\Company;
use App\Form\CompanyType;
use App\Repository\CompanyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

// Defines a prefix for all routes in the CompanyController class, accessible at URL "/company".
#[Route('/company')]
class CompanyController extends AbstractController
{
    //Defines a route for the app, which displays a list of, accessible at URL "/company"
    #[Route('/', name: 'app_company_index', methods: ['GET'])]
    public function index(CompanyRepository $companyRepository): Response
    {
        // Renders the "company/index.html.twig" template and passes the \$company variable to it.
        return $this->render('company/index.html.twig', [
            'companies' => $companyRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_company_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Creates a new Company object.
        $company = new Company();
        $form = $this->createForm(CompanyType::class, $company);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($company);
            $entityManager->flush();

            return $this->redirectToRoute('app_company_index', [], Response::HTTP_SEE_OTHER);
        }

        // Renders the "company/new.html.twig" template and passes the $company and $form variables to it.
        return $this->render('company/new.html.twig', [
            'company' => $company,
            'form' => $form,
        ]);
    }

    // Defines a route to show a company, accessible at URL "/company/{id}" 
    #[Route('/{id}', name: 'app_company_show', methods: ['GET'])]
    public function show(Company $company): Response
    {
        // Renders the "company/show.html.twig" template and passes the $company variable to it.
        return $this->render('company/show.html.twig', [
            'company' => $company,
        ]);
    }

    // Defines a route to edit a company, accessible at URL "/company/{id}/edit" 
    #[Route('/{id}/edit', name: 'app_company_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Company $company, EntityManagerInterface $entityManager): Response
    {
        // Creates a form using the CompanyType form class, and binds the $company object to it.
        $form = $this->createForm(CompanyType::class, $company);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_company_index', [], Response::HTTP_SEE_OTHER);
        }

        // Redirects the user to the list of companies.
        return $this->render('company/edit.html.twig', [
            'company' => $company,
            'form' => $form,
        ]);
    }

    // Defines a route to delete a company, accessible at URL "/company/{id}"
    #[Route('/{id}', name: 'app_company_delete', methods: ['POST'])]
    public function delete(Request $request, Company $company, EntityManagerInterface $entityManager): Response
    {
        // Security check if the CSRF token is valid.
        if ($this->isCsrfTokenValid('delete'.$company->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($company);
            $entityManager->flush();
        }

        // Redirects the user to the list of companies.
        return $this->redirectToRoute('app_company_index', [], Response::HTTP_SEE_OTHER);
    }
}
