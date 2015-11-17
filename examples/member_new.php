<?php
require __DIR__.'/../vendor/autoload.php';

use Survos\Client\SurvosClient;
use Survos\Client\Resource\MemberResource;

$config = json_decode(file_get_contents(__DIR__.'/config.json'), true);
$client = new SurvosClient($config['endpoint']);
if (!$client->authorize($config['username'], $config['password'])) {
    throw new \Exception('Wrong credentials!');
}

// get all projects
$resource = new MemberResource($client);
$resource->save(
    [
        'code'                 => "new_project_code3",
        'phone_within_project' => '+447834274476',
        'email_within_project' => 'piogrek+apitest3@gmail.com',
        'project_id'           => 10,
    ]
);

