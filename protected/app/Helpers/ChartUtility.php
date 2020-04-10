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
                'title' => self::getTitle($title, 50, 0, 'left', '#000000'),
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
                    'title' => self::getTitle('Number of '. $title, 0, 0, 'left', '#008FFB', '12px')
                ]
            ],
        );
    }

    public static function getBasicBarChartColumn(array $dataSeries, array $categoriesItems, $dateFrom, $dateTo) {
        $title = 'Number of Registered Clients from '. Carbon::parse($dateFrom)->isoFormat('MMMM Do, YYYY') . ' to ' .Carbon::parse($dateTo)->isoFormat('MMMM Do, YYYY');
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
                'title' => self::getTitle($title, 50, 0, 'left', '#000000'),
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
                    'title' => self::getTitle('Number of Registered Clients per Age Group', 0, 0, 'left', '#008FFB', '12px'),
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
                    'toolbar' => self::getToolbar(),
                ],
                'labels' => $labelItems,
            ],
            'series' => $dataSeries
        );
    }

    private static function getTitle($title, $offsetX = 0, $offsetY = 0, $align = 'left;', $color = '#008FFB', $fontSize ='14px', $fontFamily='sans-serif;', $fontWeight = 400 ) {
        return [
            'text' => $title,
            'align' => $align,
            'offsetX' => $offsetX,
            'offsetY' => $offsetY,
            'style' => [
                'fontWeight' => $fontWeight,
                'fontFamily' => $fontFamily,
                'color' => $color,
                'fontSize' => $fontSize
            ]
        ];
    }

    private static function getToolbar($zoom = false, $zoomIn = false, $zoomOut = false, $selection = false ) {
        return [
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
        ];
    }
}
