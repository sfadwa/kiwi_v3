<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class GasDashboardController extends AbstractController
{
    #[Route('/gas/dashboard', name: 'app_gas_dashboard')]
    public function index(): Response
    {
        return $this->render('gas_dashboard/index.html.twig', [
            'controller_name' => 'GasDashboardController',
        ]);
    }
}
