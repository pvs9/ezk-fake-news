<?php

return [
    'coefficients' => [
        'authenticity' => env('ANALYZE_COEFFICIENT_AUTHENTICITY', 1),
        'similarity' => env('ANALYZE_COEFFICIENT_SIMILARITY', 7),
        'tonality' => env('ANALYZE_COEFFICIENT_TONALITY', 2),
    ]
];
