<?php
require __DIR__ . '/../vendor/autoload.php';

use Survos\Client\SurvosClient;
use Survos\Client\Param\CgetParam;

$client = new SurvosClient('demo');
if (!$client->authorize('otest', 'tt')) {
    throw new \Exception('Wrong credentials!');
}

//user post
$data = [
    'username' => 'john85210101',
    'email' => 'john85210101@gmail.com',
    'name' => 'Nick',
];
$item = $client->user->post($data);
$id = $item['id'];

//user put
$item['name'] = 'John';
$item = $client->user->put($id, $item);

//user patch
$item = $client->user->patch($id, ['name' => 'Nick']);

//user get
$item = $client->user->get($id);

//user cget
$page = 1;
$maxPerPage = 10;
$criteria = ['id' => $id];
$param = new CgetParam($page, $maxPerPage, $criteria);
$response = $client->user->cget($param);

//user delete
$result = $client->user->delete($id);


//assignment cget
$param = new CgetParam(1, 10);
$data = $client->assignment->cget($param);
