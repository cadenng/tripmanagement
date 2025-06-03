<?php
header('Content-Type: application/json');

$destination = $_GET['destination'] ?? '';

// Flights and hotel data for each destination
$data = [
    'China' => [
        'flights' => [
            ['airline' => 'Air China', 'price' => 500, 'duration' => '6h'],
            ['airline' => 'China Eastern', 'price' => 550, 'duration' => '6.5h']
        ],
        'hotels' => [
            ['name' => 'Beijing Grand Hotel', 'rating' => 5, 'price' => 200, 'room_type' => 'suite', 'attractions' => ['Great Wall', 'Forbidden City']],
            ['name' => 'Shanghai Stay', 'rating' => 4, 'price' => 120, 'room_type' => 'double', 'attractions' => ['The Bund', 'Yu Garden']]
        ]
    ],
    'Malaysia' => [
        'flights' => [
            ['airline' => 'Malaysia Airlines', 'price' => 300, 'duration' => '2h'],
            ['airline' => 'AirAsia', 'price' => 250, 'duration' => '2.2h']
        ],
        'hotels' => [
            ['name' => 'KL Tower Hotel', 'rating' => 5, 'price' => 180, 'room_type' => 'suite', 'attractions' => ['Petronas Towers', 'Batu Caves']],
            ['name' => 'Penang Paradise', 'rating' => 3, 'price' => 90, 'room_type' => 'single', 'attractions' => ['George Town', 'Beach']] 
        ]
    ],
    'England' => [
        'flights' => [
            ['airline' => 'British Airways', 'price' => 700, 'duration' => '11h'],
            ['airline' => 'Virgin Atlantic', 'price' => 680, 'duration' => '10.5h']
        ],
        'hotels' => [
            ['name' => 'London Royal Inn', 'rating' => 5, 'price' => 300, 'room_type' => 'suite', 'attractions' => ['Big Ben', 'London Eye']],
            ['name' => 'Manchester Lodge', 'rating' => 4, 'price' => 150, 'room_type' => 'double', 'attractions' => ['Old Trafford', 'Museum']] 
        ]
    ],
    'America' => [
        'flights' => [
            ['airline' => 'United Airlines', 'price' => 800, 'duration' => '15h'],
            ['airline' => 'Delta', 'price' => 850, 'duration' => '14.5h']
        ],
        'hotels' => [
            ['name' => 'New York Central', 'rating' => 5, 'price' => 320, 'room_type' => 'suite', 'attractions' => ['Times Square', 'Central Park']],
            ['name' => 'LA Comfort Stay', 'rating' => 4, 'price' => 200, 'room_type' => 'double', 'attractions' => ['Hollywood', 'Beach']] 
        ]
    ]
];

// Output the relevant data or empty structure if destination not found
$response = $data[$destination] ?? ['flights' => [], 'hotels' => []];
echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
