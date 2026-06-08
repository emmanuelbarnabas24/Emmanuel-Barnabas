<?php
header('Content-Type: application/json');
require_once __DIR__ . '/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    if (!$input) {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'Invalid JSON']);
        exit;
    }

    $record = [
        'cows' => max(0, (int) ($input['cows'] ?? 0)),
        'goats' => max(0, (int) ($input['goats'] ?? 0)),
        'chickens' => max(0, (int) ($input['chickens'] ?? 0)),
        'milk_rate' => max(0, (int) ($input['milkRate'] ?? 0)),
        'egg_rate' => max(0, (int) ($input['eggRate'] ?? 0)),
        'kid_rate' => max(0, (int) ($input['kidRate'] ?? 0)),
    ];

    $statement = $pdo->prepare(
        'INSERT INTO livestock_records (cows, goats, chickens, milk_rate, egg_rate, kid_rate) VALUES (:cows, :goats, :chickens, :milk_rate, :egg_rate, :kid_rate)'
    );
    $statement->execute($record);

    echo json_encode(['status' => 'ok', 'record' => $record]);
    exit;
}

$statement = $pdo->query('SELECT * FROM livestock_records ORDER BY created_at DESC');
$records = $statement->fetchAll();

$summary = [
    'totalRecords' => count($records),
    'totalAnimals' => 0,
    'totalMilk' => 0,
    'totalEggs' => 0,
    'totalKids' => 0,
    'latest' => null,
];

foreach ($records as $record) {
    $summary['totalAnimals'] += ($record['cows'] + $record['goats'] + $record['chickens']);
    $summary['totalMilk'] += ($record['cows'] * $record['milk_rate']);
    $summary['totalEggs'] += ($record['chickens'] * $record['egg_rate']);
    $summary['totalKids'] += ($record['goats'] * $record['kid_rate']);
}

if ($summary['totalRecords'] > 0) {
    $summary['latest'] = $records[0];
    $summary['averageMilk'] = round($summary['totalMilk'] / $summary['totalRecords']);
    $summary['averageEggs'] = round($summary['totalEggs'] / $summary['totalRecords']);
    $summary['averageKids'] = round($summary['totalKids'] / $summary['totalRecords']);
} else {
    $summary['averageMilk'] = 0;
    $summary['averageEggs'] = 0;
    $summary['averageKids'] = 0;
}

echo json_encode(['status' => 'ok', 'summary' => $summary]);
