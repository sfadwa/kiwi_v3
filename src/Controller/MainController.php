<?php

namespace App\Controller;

use App\Entity\Project;
use App\Form\ProjectType;
use App\Repository\MachineRepository;
use App\Repository\ProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;

// Defines the route for the MainController and sets the prefix for all routes in this controller
#[Route('/main', name: 'dashboard_')]
class MainController extends AbstractController
{
 
    #[Route('/', name: 'general', methods: ['GET'])]
    public function generalDashboard(ChartBuilderInterface $chartBuilder, 
                                    MachineRepository $machineRepository,
                                    ProjectRepository $projectRepository): Response
    {
        // Creates a new Project object
        $project = new Project(); 
        $projects = $projectRepository->findAll(); 

        // Creates a new machine object
        $machines =$machineRepository->findAll();
        $machines = $machineRepository->findAll();

        $form = $this->createForm(ProjectType::class, $project);
        $formProject = $form->createView();

        // Creates a line chart 
        $chart1 = $chartBuilder->createChart(Chart::TYPE_LINE);
        $chart1->setData([
            'labels' => ['Week 1', 'Week 2', 'Week 3','Week 4'],
            'datasets' => [
                [
                    //legend labels hover graphic
                    'label' => 'Electricity consumed in KW',
                    //box legend + axis
                    'backgroundColor' => ['rgb(246, 179, 49)'],
                    // border box + axis
                    'borderColor' => ['rgb(246, 179, 49)'],
                    'data' => [100,60,50,40],
                    'borderWidth' => 2,
                    'fill' => true, // fill inside line
                    'tension' => 0.5, // reduce tension of line
                    'pointRadius' => 0, // no points on axis
                    'pointHitRadius' => 10, 
                    'pointBackgroundColor' => 'rgba(246, 179, 49,1)',
                    'pointBorderColor' => 'rgba(246, 179, 49, 1)',
                    'pointHoverBackgroundColor' => 'rgba(246, 179, 49, 1)',
                    'pointHoverBorderColor' => 'rgba(246, 179, 49, 1)',
                    'backgroundColor' => 'rgba(246, 179, 49,  0.2)', 
                ],
            ],
        ]);

        // Sets options for the line chart
        $chart1->setOptions([
            'responsive' => true,
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
                    'text' => 'Electicity consumed in watt',
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

        // Creates a bar chart
        $chart2 = $chartBuilder->createChart(Chart::TYPE_BAR);
        $chart2->setData([
            'labels' => ['Week 1', 'Week 2', 'Week 3','Week 4'],
            'datasets' => [
                [
                    'label' => 'Energy goal',
                    'backgroundColor' => 'rgba(245, 160, 22, 0.5)',
                    'borderColor' => 'rgb(245, 160, 22, 0.5)',
                    'borderWidth' => 1,
                    'data' => [100, 100, 100, 100],
                    'stack' => 'Stack 0',
                ],
                [
                    'label' => 'Energy consumed',
                    'backgroundColor' => 'rgba(33, 231, 141)',
                    'borderColor' => 'rgba(33, 231, 141)',
                    'borderWidth' => 1,
                    'data' => [90, 60, 50, 40],
                    'stack' => 'Stack 1',
                ],
            ],
        ]);

        // Sets options for the bar chart
        $chart2->setOptions([
            'responsive' => true,
            'indexAxis' => 'y', // Show in horizontals bars
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
                    'text' => 'Chart A',
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

        // Creates another bar chart
        $chart3 = $chartBuilder->createChart(Chart::TYPE_BAR);
        $chart3->setData([
            'labels' => ['Week 1', 'Week 2', 'Week 3','Week 4'],
            'datasets' => [
                [
                    'label' => 'Energy goal',
                    'backgroundColor' => 'rgba(245, 160, 22, 0.5)',
                    'borderColor' => 'rgb(245, 160, 22, 0.5)',
                    'borderWidth' => 1,
                    'data' => [100, 100, 100, 100],
                ],
                [
                    'label' => 'Energy consumed',
                    'backgroundColor' => 'rgba(33, 231, 141)',
                    'borderColor' => 'rgba(33, 231, 141)',
                    'borderWidth' => 1,
                    'data' => [90, 60, 50, 40],
                ],
            ],
        ]);

        // Sets options for the second bar chart
        $chart3->setOptions([
            'responsive' => true,
            'indexAxis' => 'y', // Show in horizontals bars
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
                    'text' => 'Chart B',
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

        // Creates a polar area chart
        $chart4 = $chartBuilder->createChart(Chart::TYPE_POLAR_AREA);
        $chart4->setData([
            'labels' => ['Device A', 'Device B', 'Device C', 'Device D'],
            'datasets' => [
                [
                    'label' => 'My dataset',
                    'backgroundColor' => ['rgb(255, 99, 132)', 'rgb(75, 192, 192)', 'rgb(255, 206, 86)', 'rgb(114, 255, 86)'],
                    'data' => [50, 35, 25, 15],
                ],
            ],
        ]);

        // Sets options for the polar area chart
        $chart4->setOptions([
            'responsive' => true,
            'scales' => [
                'r' => [
                    'display' => true,
                    'grid' => [
                        'color' => 'white',
                    ],
                ],
            ],
            'plugins' => [
                'title' => [
                    'display' => true,
                    'text' => 'Devices',
                    'color' => 'rgb(255, 255, 255)',
                    'font' => [
                        'size' => 16,
                    ],
                ],
                'legend' => [
                    'labels' => [
                        'color' => 'white',
                    ],
                ],
            ],
        ]);

        // Creates a radar chart
        $chart5 = $chartBuilder->createChart(Chart::TYPE_RADAR);
        $chart5->setData([
            'labels' => ['Week 1', 'Week 2', 'Week 3','Week 4'],
            'datasets' => [
                [
                    'label' => 'Energy consumed',
                    'backgroundColor' => ['rgb(255, 99, 132)', 'rgb(75, 192, 192)', 'rgb(255, 206, 86)', 'rgb(231, 233, 237)'],
                    'data' => [50, 35, 25, 15],
                ],
                [
                    'label' => 'Energy saved',
                    'backgroundColor' => ['rgb(255, 99, 132)', 'rgb(75, 192, 192)', 'rgb(255, 206, 86)', 'rgb(231, 233, 237)'],
                    'data' => [20, 40, 35, 21],
                ],
            ],
        ]);

        // Sets options for the radar chart          
        $chart5->setOptions([
            'responsive' => true,
            'scales' => [
                'r' => [
                    'display' => true,
                    'grid' => [
                        'color' => 'white',
                    ],
                ],
            ],
            'plugins' => [
                'title' => [
                    'display' => true,
                    'text' => 'Energy consumption',
                    'color' => 'rgb(255, 255, 255)',
                    'font' => [
                        'size' => 16,
                    ],
                ],
                'legend' => [
                    'labels' => [
                        'color' => 'white',
                    ],
                ],
            ],
        ]);

        // Renders the general dashboard template and passes the charts, machines, projects, and form view as variables
        return $this->render('main/dashboard.html.twig', [
            'chart1' => $chart1,
            'chart2' => $chart2,
            'chart3' => $chart3,
            'chart4' => $chart4,
            'chart5' => $chart5,
            'machines' => $machines,
            'projects' => $projects,
            'form' => $formProject,
        ]);
    }
}