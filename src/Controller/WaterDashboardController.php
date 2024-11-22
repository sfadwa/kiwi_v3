<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class WaterDashboardController extends AbstractController
{
    #[Route('/water/dashboard', name: 'app_water_dashboard')]
    public function index(): Response
    {
        return $this->render('water_dashboard/index.html.twig', [
            'controller_name' => 'WaterDashboardController',
        ]);
    }
}
