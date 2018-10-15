<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Default library used in charts.
    |--------------------------------------------------------------------------
    |
    | This value is used as the default chart library used when creating
    | any chart in the command line. Feel free to modify it or set it up
    | while creating the chart to ignore this value.
    |
    */
    'default_library' => 'Chartjs',
    'default' => [
        'type' => 'line',
        'library' => 'google',
        'element_label' => 'Element',
        'title' => 'My chart',
        'height' => 400,
        'width' => 500,
        'responsive' => true,
    ],
];
