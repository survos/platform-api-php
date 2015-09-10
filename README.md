# Survos php api client

## Authenticating
```php
require __DIR__ . '/../vendor/autoload.php';

use Survos\Client\SurvosClient;

$client = new SurvosClient('demo');
if (!$client->authorize('otest', 'tt')) {
    throw new \Exception('Wrong credentials!');
}
```

## Create new item (POST)
```php
$data = [
    'username' => 'john85210101',
    'email' => 'john85210101@gmail.com',
    'name' => 'Nick',
];
$item = $client->user->post($data);
$id = $item['id'];
```

## Update item
```php
//PUT
$item['name'] = 'John';
$item = $client->user->put($id, $item);
//OR PATCH IT
$item = $client->user->patch($id, ['name' => 'Nick']);
```
## Get item
```php
$item = $client->user->get($id);
```
## Get paginated items
```php
use Survos\Client\Param\CgetParam;

$page = 1;
$maxPerPage = 10;
$criteria = ['id' => $id];
$param = new CgetParam($page, $maxPerPage, $criteria);
$response = $client->user->cget($param);
```
## Delete item
```php
$result = $client->user->delete($id);
```

