<?php
require __DIR__.'/../vendor/autoload.php';

use Survos\Client\SurvosClient;
use Survos\Client\Resource\DataImageResource;
use Survos\Client\SurvosCriteria;

$config = json_decode(file_get_contents(__DIR__.'/config.json'), true);
$client = new SurvosClient($config['endpoint']);
if (!$client->authorize($config['username'], $config['password'])) {
    throw new \Exception('Wrong credentials!');
}

/**
 * get list of images created after 2015-06-25 22:40:54
 * and with field 'time' matching 'afternoon'
 */

$resource = new DataImageResource($client);
$filter = ['created_at' => ['after' => '2015-06-25 22:40:54', 'before' => '2015-06-26']];
$filter['flatData'] = 'time=afternoon';

$data = $resource->getList($filter);
$items = $data['items'];
