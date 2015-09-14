<?php
require __DIR__ . '/../vendor/autoload.php';

use Survos\Client\SurvosClient;

$config = json_decode(file_get_contents(__DIR__.'/config.json'), true);
$client = new SurvosClient($config['endpoint']);
if (!$client->authorize($config['username'], $config['password'])) {
    throw new \Exception('Wrong credentials!');
}

$data = $client->getMember()->getApplicants(1, 100);
$applicants = $data['items'];

$ids = [];
foreach ($applicants as $applicant) {
    $ids[] = $applicant['id'];
}
if (!empty($ids)) {
    $action = rand(0, 1) === 1 ? 'accept' : 'reject';
    $result = $client->getMember()->setApplicantsStatus($ids, $action);
}
