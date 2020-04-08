<?php

namespace App\Helpers;

use Carbon\Carbon;

class ChartUtility {

    public static function getStackedColumn(array $dataSeries, array $categoriesItems, $title) {
        return array(
            'series' => $dataSeries,
            'options' => [
                'chart' => [
                    'height' => 350,
                    'type' => 'bar',
                    'stacked' => true,
                    'toolbar' => [
                        'show' => true
                    ],
                    'zoom' => [
                        'enabled' => true,
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

    public static function getBasicColumn(array $dataSeries, array $categoriesItems, $dateFrom, $dateTo) {
        return array(
            'series' => $dataSeries,
            'options' => [
                'chart' => [
                    'height' => 350,
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
                ]
            ],
        );
    }

    public static function getBasicPieChartData(array $dataSeries, array $labelItems) {
        return array(
            'options' => [
                'chart' => [
                    'width' => 400,
                    'type' => 'pie',
                ],
                'labels' => $labelItems,
            ],
            'series' => $dataSeries
        );
    }
}
