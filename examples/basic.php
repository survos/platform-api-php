<?php
require __DIR__ . '/../vendor/autoload.php';

use Survos\Client\SurvosClient;
use Survos\Client\Resource\UserResource;

$config = json_decode(file_get_contents(__DIR__.'/config.json'), true);
$client = new SurvosClient($config['endpoint']);
if (!$client->authorize($config['username'], $config['password'])) {
    throw new \Exception('Wrong credentials!');
}

//user save
$data = [
    'username' => 'john85210101',
    'email' => 'john85210101@gmail.com',
    'name' => 'Nick',
];
$resource = new UserResource($client);;
$item = $resource->save($data);
$id = $item['id'];

//user getById
$item = $resource->getById($id);

//user getList
$page = 1;
$itemsPerPage = 10;
$criteria = ['id' => $id];
$response = $resource->getList($criteria, [], $page, $itemsPerPage);


//user delete
$result = $resource->deleteById($id);