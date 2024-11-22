<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ElectricityDashboardController extends AbstractController
{
    #[Route('/electricity/dashboard', name: 'app_electricity_dashboard')]
    public function index(): Response
    {
        return $this->render('electricity_dashboard/index.html.twig', [
            'controller_name' => 'ElectricityDashboardController',
        ]);
    }
}
