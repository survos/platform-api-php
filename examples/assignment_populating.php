<?php
require __DIR__ . '/../vendor/autoload.php';

$config = json_decode(file_get_contents(__DIR__.'/config.json'), true);
$client = new \Survos\Client\SurvosClient($config['endpoint']);
if (!$client->authorize($config['username'], $config['password'])) {
    throw new \Exception('Wrong credentials!');
}

$project = 'behattest';
$memberCode = 'otest';
$date = '2016-01-31';

$assignments = getTrackingAssignments($client, $project, $memberCode, $date);

foreach ($assignments['items'] as $assignment) {
    $tracks = getTracks($client, $assignment['scheduled_time'], $assignment['scheduled_end_time']);
    if (false !== $center = getTracksCenter($tracks)) {
        $assignment['center_lat_lng'] = $center;
        saveAssignment($client, $assignment);
    }
}

function getTrackingTasks($client) {
    $resource = new \Survos\Client\Resource\TaskResource($client);
    return $resource->getList(['task_type_code' => 'device']);
}

function getTrackingAssignments($client, $project = null, $memberCode = null, $date = null) {
    $resource = new \Survos\Client\Resource\AssignmentResource($client);
    $filter = ['score' => ['gte' => 0]];
    $filter = ['task_type_code' => 'device'];
    if (null !== $project) {
        $filter['project_code'] = $project;
    }
    if (null !== $memberCode) {
        $filter['member_code'] = $memberCode;
    }
    if (null !== $date) {
        $filter['scheduled_time']['after'] = $date;
        $filter['scheduled_end_time']['before'] = $date;
    }
    return $resource->getList($filter);
}

function saveAssignment($client, $data) {
    $resource = new \Survos\Client\Resource\AssignmentResource($client);
    $response = $resource->save($data);
}

function getTracks($client, $fromTime, $toTime) {
    $filter = ['timestamp' => ['after' => $fromTime, 'before' => $toTime]];
    $orderBy = ['timestamp' => 'asc'];
    $resource = new \Survos\Client\Resource\TrackResource($client);
    return $resource->getList($filter, $orderBy);
}

function getTracksCenter(array $tracks) {
    $points = [];
    foreach ($tracks['items'] as $track) {
        $points[] = [$track['latitude'], $track['longitude']];
    }
    return GetCenterFromDegrees($points);
}

/**
 * Get a center latitude,longitude from an array of like geopoints
 * Taken from here http://stackoverflow.com/a/18623672
 * Eventually can be used https://github.com/bdelespierre/php-kmeans
 * @param array $data
 * @return array|bool
 */
function GetCenterFromDegrees($data)
{
    if (!is_array($data)) return FALSE;

    $num_coords = count($data);

    $X = 0.0;
    $Y = 0.0;
    $Z = 0.0;

    foreach ($data as $coord)
    {
        $lat = $coord[0] * pi() / 180;
        $lon = $coord[1] * pi() / 180;

        $a = cos($lat) * cos($lon);
        $b = cos($lat) * sin($lon);
        $c = sin($lat);

        $X += $a;
        $Y += $b;
        $Z += $c;
    }

    $X /= $num_coords;
    $Y /= $num_coords;
    $Z /= $num_coords;

    $lon = atan2($Y, $X);
    $hyp = sqrt($X * $X + $Y * $Y);
    $lat = atan2($Z, $hyp);

    return array($lat * 180 / pi(), $lon * 180 / pi());
}