<?php
//it's not ready yet.
require __DIR__ . '/../vendor/autoload.php';

$config = json_decode(file_get_contents(__DIR__.'/config.json'), true);
$client = new \Survos\Client\SurvosClient($config['endpoint']);
if (!$client->authorize($config['username'], $config['password'])) {
    throw new \Exception('Wrong credentials!');
}


$assignments = getTrackingAssignments($client);

foreach ($assignments['items'] as $assignment) {
    $tracks = getTracks($client, $assignment['scheduled_time'], $assignment['scheduled_end_time']);
}


function getTrackingTasks($client) {
    $resource = new \Survos\Client\Resource\TaskResource($client);
    return $resource->getList(null, null, ['task_type_code' => 'device']);
}

function getTrackingAssignments($client) {
    $resource = new \Survos\Client\Resource\AssignmentResource($client);
    $filter = ['score' => 0];
    $comparison = ['score' => \Survos\Client\SurvosCriteria::GREATER_THAN];
    $params = ['task_type_code' => 'device'];
    return $resource->getList(null, null, $filter, $comparison, null, $params);
}

function getTracks($client, $fromTime, $toTime) {
    //['2016-01-25', '2016-01-26']
    $filter = ['timestamp' => ['min' => '2016-01-25 18:40:23', 'max' => '2016-01-26 18:40:23']];
//    $filter = ['timestamp' => [$fromTime, $toTime]];
    $comparison = null;//['timestamp' => \Survos\Client\SurvosCriteria::BETWEEN];
    $resource = new \Survos\Client\Resource\TrackResource($client);
    return $resource->getList(null, null, $filter, $comparison);
}
