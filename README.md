# Survos php api client

## Authenticating
```php
require __DIR__ . '/../vendor/autoload.php';

use Survos\Client\SurvosClient;

$client = new SurvosClient('https://demo.survos.com/api1.0/');
if (!$client->authorize('otest', 'tt')) {
    throw new \Exception('Wrong credentials!');
}
```

## Save item
```php
use Survos\Client\Resource\UserResource;

$data = [
    'username' => 'john85210101',
    'email' => 'john85210101@gmail.com',
    'name' => 'Nick',
];
$resource = new UserResource($client);;
$item = $resource->save($data);
$id = $item['id'];
```

## Get item
```php
$item = $resource->getById($id);
```
## Get paginated items
```php
$page = 1;
$maxPerPage = 10;
$criteria = ['id' => $id];
$response = $resource->getList($page, $maxPerPage, $criteria);
```
## Delete item
```php
$result = $resource->deleteById($id);
```

