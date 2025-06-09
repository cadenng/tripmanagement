<?php
header('Content-Type: application/json');

$destination = $_GET['destination'] ?? '';

// Flights and hotel data for each destination
$data = [
    'China' => [
        'flights' => [
            ['airline' => 'Air China', 'price' => 500, 'duration' => '6h'],
            ['airline' => 'China Eastern', 'price' => 550, 'duration' => '6.5h'],
            ['airline' => 'Hainan Airlines', 'price' => 500, 'duration' => '6h'],
            ['airline' => 'XiamenAir', 'price' => 580, 'duration' => '6.8h'],
            ['airline' => 'Shenzhen Airlines', 'price' => 540, 'duration' => '6.3h']
        ],
        'hotels' => [
            ['name' => 'Beijing Grand Hotel', 'rating' => 5, 'price' => 200, 
            'room_type' => 'suite', 'attractions' => ['Great Wall', 'Forbidden City']],
            ['name' => 'Shanghai Stay', 'rating' => 4, 'price' => 120, 
            'room_type' => 'double', 'attractions' => ['The Bund', 'Yu Garden']],
            ['name' => 'Guangzhou Garden Inn', 'rating' => 3, 'price' => 90,
            'room_type' => 'single', 'attractions' => ['Canton Tower', 'Baiyun Mountain']],
            ['name' => 'Chengdu Comfort', 'rating' => 4, 'price' => 110, 
            'room_type' => 'twin', 'attractions' => ['Giant Panda Base', 'Wuhou Shrine']],
            ['name' => 'Xi An Heritage Hotel', 'rating' => 4, 'price' => 100,
             'room_type' => 'double', 'attractions' => ['Terracotta Army', 'Ancient City Wall']]
        ]
    ],
    'Malaysia' => [
        'flights' => [
            ['airline' => 'Malaysia Airlines', 'price' => 300, 'duration' => '2h'],
            ['airline' => 'AirAsia', 'price' => 250, 'duration' => '2.2h'],
            ['airline' => 'Malindo Air', 'price' => 350, 'duration' => '4.8h'],
            ['airline' => 'Firefly', 'price' => 300, 'duration' => '4.2h'],
            ['airline' => 'Batik Air Malaysia', 'price' => 370, 'duration' => '5.1h']
        ],
        'hotels' => [
            ['name' => 'KL Tower Hotel', 'rating' => 5, 'price' => 180, 'room_type' => 'suite', 'attractions' => ['Petronas Towers', 'Batu Caves']],
            ['name' => 'Penang Paradise', 'rating' => 3, 'price' => 90, 'room_type' => 'single', 'attractions' => ['George Town', 'Beach']],
            ['name' => 'Langkawi Lagoon Resort', 'rating' => 5, 'price' => 150, 'room_type' => 'suite', 'attractions' => ['Langkawi Sky Bridge', 'Underwater World']],
            ['name' => 'Malacca Heritage Stay', 'rating' => 4, 'price' => 95, 'room_type' => 'twin', 'attractions' => ['A Famosa', 'Jonker Street']],
            ['name' => 'Sabah Seaside Hotel', 'rating' => 3, 'price' => 85, 'room_type' => 'double', 'attractions' => ['Mount Kinabalu', 'Tunku Abdul Rahman Park']]
        ]
    ],
    'England' => [
        'flights' => [
            ['airline' => 'British Airways', 'price' => 700, 'duration' => '11h'],
            ['airline' => 'Virgin Atlantic', 'price' => 680, 'duration' => '10.5h'],
            ['airline' => 'EasyJet', 'price' => 700, 'duration' => '12.2h'],
            ['airline' => 'Jet2', 'price' => 740, 'duration' => '11.8h'],
            ['airline' => 'Ryanair', 'price' => 690, 'duration' => '12.5h']
        ],
        'hotels' => [
            ['name' => 'London Royal Inn', 'rating' => 5, 'price' => 300, 'room_type' => 'suite', 'attractions' => ['Big Ben', 'London Eye']],
            ['name' => 'Manchester Lodge', 'rating' => 4, 'price' => 150, 'room_type' => 'double', 'attractions' => ['Old Trafford', 'Museum']],
            ['name' => 'Liverpool Lodge', 'rating' => 3, 'price' => 110, 'room_type' => 'single', 'attractions' => ['The Beatles Story', 'Albert Dock']],
            ['name' => 'Oxford Heritage Inn', 'rating' => 4, 'price' => 130, 'room_type' => 'twin', 'attractions' => ['Oxford University', 'Bodleian Library']],
            ['name' => 'Bristol Bay Stay', 'rating' => 3, 'price' => 100, 'room_type' => 'double', 'attractions' => ['Clifton Suspension Bridge', 'Bristol Zoo']]
        ]
    ],
    'America' => [
        'flights' => [
            ['airline' => 'United Airlines', 'price' => 800, 'duration' => '15h'],
            ['airline' => 'Delta Airlines', 'price' => 850, 'duration' => '14.5h'],
            ['airline' => 'United Airlines', 'price' => 820, 'duration' => '14.2h'],
            ['airline' => 'Southwest Airlines', 'price' => 780, 'duration' => '13.8h'],
            ['airline' => 'Alaska Airlines', 'price' => 800, 'duration' => '13.7h']
        ],
        'hotels' => [
            ['name' => 'New York Central', 'rating' => 5, 'price' => 320, 'room_type' => 'suite', 'attractions' => ['Times Square', 'Central Park']],
            ['name' => 'LA Comfort Stay', 'rating' => 4, 'price' => 200, 'room_type' => 'double', 'attractions' => ['Hollywood', 'Beach']],
            ['name' => 'Chicago Comfort Inn', 'rating' => 3, 'price' => 130, 'room_type' => 'single', 'attractions' => ['Millennium Park', 'Navy Pier']],
            ['name' => 'Orlando Family Resort', 'rating' => 5, 'price' => 200, 'room_type' => 'suite', 'attractions' => ['Walt Disney World', 'Universal Studios']],
            ['name' => 'San Francisco Stay', 'rating' => 4, 'price' => 170, 'room_type' => 'twin', 'attractions' => ['Golden Gate Bridge', 'Alcatraz Island']]
        ]
    ]
];

// Output the relevant data or empty structure if destination not found
$response = $data[$destination] ?? ['flights' => [], 'hotels' => []];
echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
