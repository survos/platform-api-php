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

$acceptIds = [];
$rejectIds = [];
foreach ($applicants as $applicant) {
    $id = $applicant['id'];
    if (isEligible($applicant)) {
        $acceptIds[] = $id;
    } else {
        $rejectIds[] = $id;
    }
}
if (!empty($acceptIds)) {
    $client->getMember()->setApplicantsStatus($acceptIds, 'accept', null, 'qualified by age');
}
if (!empty($rejectIds)) {
    $client->getMember()->setApplicantsStatus($rejectIds, 'reject', null, 'Sorry, you don\'t qualify');
}

function isEligible($applicant){
    return isset($applicant['submitted']) && $applicant['submitted']['age'] < 21;
}