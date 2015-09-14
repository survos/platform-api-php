<?php
require __DIR__ . '/../vendor/autoload.php';

use Survos\Client\SurvosClient;

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
$item = $client->getUser()->save($data);
$id = $item['id'];

//user getById
$item = $client->getUser()->getById($id);

//user getList
$page = 1;
$maxPerPage = 10;
$criteria = ['id' => $id];
$response = $client->getUser()->getList($page, $maxPerPage, $criteria);


//user delete
$result = $client->getUser()->deleteById($id);