<?php
require __DIR__.'/../vendor/autoload.php';

use Survos\Client\SurvosClient;
use Survos\Client\Resource\ServerResource;

$config = json_decode(file_get_contents(__DIR__.'/config.json'), true);
$client = new SurvosClient($config['endpoint']);
if (!$client->authorize($config['username'], $config['password'])) {
    throw new \Exception('Wrong credentials!');
}

// get all projects
$resource = new ServerResource($client);
$res = $resource->save(
    [
        'title'       => "new server",
        'code'        => "new_server_code",
        'timezone_id' => 1,
    ]
);

