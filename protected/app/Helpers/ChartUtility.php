<?php

namespace App\Helpers;

use Carbon\Carbon;

class ChartUtility {

    public static function getStackedColumn(array $dataSeries, array $categoriesItems, $title) {
        return array(
            'series' => $dataSeries,
            'options' => [
                'chart' => [
                    'height' => 365,
                    'type' => 'bar',
                    'stacked' => true,
                    'toolbar' => [
                        'show' => true
                    ],
                    'zoom' => [
                        'enabled' => false,
                    ],
                ],
                'dataLabels' => [
                    'enabled' => false,
                ],
                'title' => [
                    'text' =>  $title,
                    'align' => 'left',
                    'offsetX' => 50
                ],
                'plotOptions' => [
                    'bar' => [
                      'horizontal' => false,
                    ],
                ],
                'xaxis' => [
                    'categories' => $categoriesItems
                ],
                'legend' => [
                    'position' => 'right',
                    'offsetY' => 40
                ],
                'fill' => [
                    'opacity' => 1
                ],
                'yaxis' => [
                    'axisTicks' => [
                        'show' => true,
                    ],
                    'axisBorder' => [
                        'show' => true,
                        'color' => '#008FFB'
                    ],
                    'labels' => [
                        'style' => [
                            'colors' => '#008FFB'
                        ]
                    ],
                    'title' => [
                        'text' => 'Number of '. $title,
                        'style' => [
                            'colors' => '#008FFB'
                        ]
                    ]
                ]
            ],
        );
    }

    public static function getBasicBarChartColumn(array $dataSeries, array $categoriesItems, $dateFrom, $dateTo) {
        return array(
            'series' => $dataSeries,
            'options' => [
                'chart' => [
                    'height' => 365,
                    'type' => 'line',
                    'stacked' => false
                ],
                'dataLabels' => [
                    'enabled' => false,
                ],
                'stroke' => [
                    'width' => [1, 1],
                    'curve' => 'smooth'
                ],
                'title' => [
                    'text' => 'Number of Registered Clients from '. Carbon::parse($dateFrom)->isoFormat('MMMM Do, YYYY') . ' to ' .Carbon::parse($dateTo)->isoFormat('MMMM Do, YYYY'),
                    'align' => 'left',
                    'offsetX' => 50
                ],
                'xaxis' => [
                    'categories' => $categoriesItems
                ],
                'yaxis' => [
                    'axisTicks' => [
                        'show' => true,
                    ],
                    'axisBorder' => [
                        'show' => true,
                        'color' => '#008FFB'
                    ],
                    'labels' => [
                        'style' => [
                            'colors' => '#008FFB'
                        ]
                    ],
                    'title' => [
                        'text' => 'Number of Registered Clients per Age Group',
                        'style' => [
                            'colors' => '#008FFB'
                        ]
                    ]
                ],
                'legend' => [
                    'position' => 'right',
                    'offsetY' => 40
                ],
                'fill' => [
                    'opacity' => 1
                ],
            ],
        );
    }

    public static function getBasicPieChartData(array $dataSeries, array $labelItems, $height = 365) {
        return array(
            'options' => [
                'chart' => [
                    'height' => $height,
                    'type' => 'pie',
                    'toolbar' => [
                        'show' => true,
                        'offsetX' => 0,
                        'offsetY' => 0,
                        'tools' => [
                          'download' => true,
                          'selection' => true,
                          'zoom' => true,
                          'zoomin' => true,
                          'zoomout' => true,
                          'pan' => true,
                          'reset' => true,
                        ],
                        'autoSelected' => 'zoom'
                    ],
                ],
                'labels' => $labelItems,
            ],
            'series' => $dataSeries
        );
    }
}
