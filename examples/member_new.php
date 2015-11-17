<?php
require __DIR__.'/../vendor/autoload.php';

use Survos\Client\SurvosClient;
use Survos\Client\Resource\MemberResource;
use Survos\Client\Resource\ProjectResource;

$config = json_decode(file_get_contents(__DIR__.'/config.json'), true);
$client = new SurvosClient($config['endpoint']);
if (!$client->authorize($config['username'], $config['password'])) {
    throw new \Exception('Wrong credentials!');
}

// get all projects
$userResource = new \Survos\Client\Resource\UserResource($client);
//$user= $userResource->getOneBy('username', 'tac');
$pResource = new ProjectResource($client);
$project = $pResource->getByCode('demo');

$resource = new MemberResource($client);
$resource->save(
    [
        'code'                 => "new_project_code4",
        'phone_within_project' => '+447834274473',
        'email_within_project' => 'piogrek+apitest4@gmail.com',
        'project_id'           => $project['id'],
    ]
);

$res = $pResource->addModule('demo', 'field');
echo $res;

