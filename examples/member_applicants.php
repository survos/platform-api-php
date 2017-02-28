<?php
require __DIR__ . '/../vendor/autoload.php';

use Survos\Client\SurvosClient;
use Survos\Client\Resource\MemberResource;

$config = json_decode(file_get_contents(__DIR__.'/config.json'), true);
$client = new SurvosClient($config['endpoint']);
if (!$client->authorize($config['username'], $config['password'])) {
    throw new \Exception('Wrong credentials!');
}

$resource = new MemberResource($client);
$data = $resource->getList(['enrollment_status_code' => 'applicant']);
$applicants = $data['items'];

foreach ($applicants as $applicant) {
    $id = $applicant['id'];
    if (isEligible($applicant)) {
        $resource->setApplicantsStatus($id, 'accept', null, 'qualified by age');
    } else {
        $resource->setApplicantsStatus($id, 'reject', null, 'Sorry, you don\'t qualify');
    }
}

function isEligible($applicant){
    return isset($applicant['submitted']) && $applicant['submitted']['age'] < 21;
}
