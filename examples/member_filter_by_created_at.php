<?php
require __DIR__ . '/../vendor/autoload.php';

use Survos\Client\SurvosClient;
use Survos\Client\Resource\MemberResource;
use Survos\Client\SurvosCriteria;

$config = json_decode(file_get_contents(__DIR__.'/config.json'), true);
$client = new SurvosClient($config['endpoint']);
if (!$client->authorize($config['username'], $config['password'])) {
    throw new \Exception('Wrong credentials!');
}

$resource = new MemberResource($client);
$filter = ['created_at' => ['after' => '2015-09-16 18:40:23', 'before' => '2015-09-20']];
$data = $resource->getList($filter, [], 1, 100);
$items = $data['items'];
