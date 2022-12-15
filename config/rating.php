<?php

use Laraveles\Models\Rating;

return [
    'models' => [
        'rating' => Rating::class,
    ],
    'required_approval' => true,
    'from' => 1,
    'to' => 5,
];
