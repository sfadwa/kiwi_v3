<?php

namespace App\Controller;

use App\Form\DataboardType;
use App\Repository\MachineRepository;
use App\Repository\ProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;

// Define the base route for the DataboardController with the prefix '/databoard'
// and the base name for the routes as 'databoard_'.
#[Route('/databoard', name: 'databoard_')]
class DataboardController extends AbstractController
{
    // Define a route for the index action with the URL '/' and the name 'general'.
    #[Route('/', name: 'general')]
    public function index(ChartBuilderInterface $chartBuilder,
                            MachineRepository $machineRepository,
                            ProjectRepository $projectRepository): Response
    {
        // Fetch all the projects from the database.
        $projects = $projectRepository->findAll();

        // Fetch all the machines from the database.
        $machines = $machineRepository->findAll();

        // Create a bar chart for the weekly energy consumption.
        $WeeklyChart = $chartBuilder->createChart(Chart::TYPE_BAR);

        // Set data for the chart.
        $WeeklyChart->setData([
            'labels' => ['Jan', 'Feb', 'Mar','Apr','May', 'Jun', 'Jul','Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            'datasets' => [
                [
                    'label' => 'Energy consumed',
                    'backgroundColor' => 'rgba(33, 231, 141)',
                    'borderColor' => 'rgba(33, 231, 141)',
                    'borderWidth' => 1,
                    'data' => [40, 60, 50, 40, 50, 40, 80, 75, 35, 60, 90, 85],
                    'stack' => 'Stack 1',
                ],
            ],
        ]);

        // Set options for the chart.
        $WeeklyChart->setOptions([
            'responsive' => true,
            'indexAxis' => 'x', // Showing in vertical bars
            'scales' => [
                'x' => [
                    'ticks' => [
                        'color' => 'white', // Color of label axis x
                    ],
                    'grid' => [
                        'color' => 'white', // Color of line axis x
                    ],
                ],
                'y' => [
                    'beginAtZero' => true,
                    'ticks' => [
                        'color' => 'white', // Color of label axis y
                    ],
                    'grid' => [
                        'color' => 'black', // Color of line axis y
                    ],
                ],
            ],
            'plugins' => [
                'title' => [
                    'display' => true,
                    'text' => 'Monthly',
                    'color' => ['rgb(255, 255, 255)'],
                    'font' => [
                        'size' => 16,
                    ],
                ],
                'legend' => [
                    'display' => false,                    
                ],
            ],
        ]);

        // Render the view with the projects, machines, and the weekly energy consumption chart.
        return $this->render('databoard/index.html.twig', [
            'WeeklyChart' => $WeeklyChart,
            'machines' => $machines,
            'projects' => $projects,
        ]);
    }
}
