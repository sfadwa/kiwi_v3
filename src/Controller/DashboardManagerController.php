<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;

// Define the base route for the DashboardManagerController with the prefix '/dashboardManager'
// and the base name for the routes as 'dashboard_'.
#[Route('/dashboardManager', name: 'dashboard_')]
class DashboardManagerController extends AbstractController
{

    // Define a route for the generalDashboard action with the URL '/' and the name 'manager'.
    #[Route('/', name: 'manager', methods: ['GET'])]
    public function generalDashboard(ChartBuilderInterface $chartBuilder): Response
    {
        // Create a doughnut chart for cost comparison
        $chart1 = $chartBuilder->createChart(Chart::TYPE_DOUGHNUT);

        // Set data for the chart
        $chart1->setData([
            'labels' => ['Electricity', 'Gas', 'Water'], //x-axis (horizontal)
            'datasets' => [
                [
                    //legend labels
                    'label' => 'Cost_energy',
                    //box legend + axis
                    'backgroundColor' => ['rgb(255, 99, 132)', 'rgb(255, 205, 86)', 'rgb(54, 162, 235)'],
                    // border box + axis
                    'borderColor' => ['rgb(255, 99, 132)', 'rgb(255, 205, 86)', 'rgb(54, 162, 235)'],
                    'data' => [50,30,20],
                ],
            ],
        ]);

        // Set options for the chart
        $chart1->setOptions([
            'plugins' => [
                'title' => [
                    'display' => true,
                    'text' => 'Cost Comparison',
                    'color' => ['rgb(255, 255, 255)'],
                    'font' => [
                        'size' => 16,
                    ],
                ],
                'legend' => [
                    'display' => true,
                    'position' => 'right',
                    'labels' => [
                        'boxWidth' => 15,
                        'color' => 'rgb(255, 255, 255)',
                    ],
                ],
            ],
        ]);

        // Create a bar chart for cost variation
        $chart2 = $chartBuilder->createChart(Chart::TYPE_BAR);

        // Set options for the chart
        $chart2->setData([
            'labels' => ['January', 'February'],
            'datasets' => [
                [
                    //legend labels
                    'label' => 'My First dataset',
                    //box legend + axis
                    'backgroundColor' => ['rgb(8, 233, 240, 0.5)','rgb(8, 233, 240)'],
                    // border box + axis
                    'borderColor' => ['rgb(8, 233, 240, 0.5)','rgb(8, 233, 240)'],
                    'data' => [200, 145],
                ],
            ],
        ]);

        $chart2->setOptions([
            'plugins' => [
                'title' => [
                    'display' => true,
                    'text' => 'Cost Variation',
                    'color' => 'rgb(255, 255, 255)',
                    'font' => [
                        'size' => 16,
                    ],
                ],
                'legend' => [
                    'display' => false, // Do not display the legend
                ],
            ],
            'scales' => [
                'x' => [
                    'barThickness' => 5, // Width of the bars
                    'ticks' => [
                        'color' => 'rgb(255, 255, 255)', // Color of the labels in white
                    ],
                ],
            ],
        ]);


                // Create a bar chart for emission and green energy
                $chart3 = $chartBuilder->createChart(Chart::TYPE_BAR);

                // Set data for the chart
                $chart3->setData([
                    'labels' => ['Emission', 'Green Energy'],
                    'datasets' => [
                        [
                            'label' => 'Emission goal',
                            'backgroundColor' => 'rgba(245, 160, 22, 0.5)',
                            'borderColor' => 'rgb(245, 160, 22, 0.5  )',
                            'borderWidth' => 1, // Border width
                            'data' => [100, 0],  // Values for Emission goal
                        ],
                        [
                            'label' => 'Emission consumed',
                            'backgroundColor' => 'rgba(245, 160, 22 )',
                            'borderColor' => 'rgb(245, 160, 22  )',
                            'borderWidth' => 1, // Border width
                            'data' => [60, 0],  // Values for Emission consumed
                        ],
                        [
                            'label' => 'Green Energy Goal',
                            'backgroundColor' => 'rgba(33, 231, 141, 0.5)',
                            'borderColor' => 'rgb(33, 231, 141, 0.5)',
                            'data' => [0, 100],  // Values for Green Energy Goal
                        ],
                        [
                            'label' => 'Green Energy',
                            'backgroundColor' => 'rgba(33, 231, 141)',
                            'borderColor' => 'rgb(33, 231, 141)',
                            'data' => [0, 40],  // Values for Green Energy Generated
                        ],
                    ],
                ]);
        
                // Set options for the chart
                $chart3->setOptions([
                    'indexAxis' => 'y', // Show horizontal bars
                    'scales' => [
                        'yAxes' => [
                            [
                                'position' => 'left', // Position of axis y of the 1st bar
                            ],
                            [
                                'position' => 'right', // Position of axis y of the 2nd bar
                            ],
                        ],
                    ],
                    'barThickness' => 10,
                    'plugins' => [
                        'title' => [
                            'display' => true,
                            'text' => 'Emission C02',
                            'color' => ['rgb(255, 255, 255)'],
                            'font' => [
                                'size' => 16,
                            ],
                        ],
                        'legend' => [
                            'display' => true,
                            'position' => 'bottom',
                            'labels' => [
                                'boxWidth' => 15,
                                'color' => 'rgb(255, 255, 255)',
                                'padding' => 10,
                            ],
                        ],
                    ],
                ]);
        
                // Create a doughnut chart for energy intensity
                $chart4 = $chartBuilder->createChart(Chart::TYPE_DOUGHNUT);
        
                // Set data for the chart
                $chart4->setData([
                    'labels' => ['Consumed', 'Goal'],
                    'datasets' => [
                        [
                            'label' => 'Energy Intensity',
                            'backgroundColor' => ['rgb(74, 163, 162)', 'rgb(255, 205, 86)'],
                            'borderColor' => ['rgb(74, 163, 162)', 'rgb(255, 205, 86)'],
                            'data' => [160,100],
                        ],
                    ],
                ]);
        
                // Set options for the chart
                $chart4->setOptions([
                    'indexAxis' => 'y', // Show horizontal bars
                    'cutout' => 120, // Inside doughnut gap
                    'circumference' => 180,
                    'rotation' => -90, // Rotation of the graphic
                    'plugins' => [
                        'title' => [
                            'display' => true,
                            'text' => 'Energy intensity',
                            'color' => ['rgb(255, 255, 255)'],
                            'font' => [
                                'size' => 16,
                            ],
                        ],
                        'legend' => [
                            'labels' => [
                                'color' => 'rgb(255, 255, 255)',
                            ],
                        ],
                        'doughnutLabel' => [
                            'color' => 'rgb(255, 255, 255)',
                            'font' => [
                                'size' => 14,
                            ],
                            'position' => 'center',
                        ],
                    ],
                    'scales' => [
                        'y' => [
                            'display' => false, // Do not show the scale
                        ],
                    ],
                ]);
        
                // Render the view with the charts
                return $this->render('dashboardManager/index.html.twig', [
                    'chart1' => $chart1,
                    'chart2' => $chart2,
                    'chart3' => $chart3,
                    'chart4' => $chart4,
                ]);
            }
        }