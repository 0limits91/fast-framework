[![Fast Framework Logo](https://www.francescocappa.it/fast-framework/docs/assets/logo.png)](https://www.francescocappa.it/fast-framework/)

# Fast-Framework
Fast is a fast, simple, extensible framework for PHP. Fast enables you to quickly and easily build RESTful web applications.

## Basic Example
```php
include __DIR__ . '/../src/autoload.php';
$app = new \FastFramework\Application();

$app->get('/', function ($req, $res) {
    $res->send('Hello, World!');
});

$app->run();
```

## Routing
```php
//GET
$app->get('/', function ($req, $res) {
	$res->send('Hello World!');
});

//POST
$app->post('/', function ($req, $res) {
	$res->send('Got a POST request');
});

//PUT
$app->put('user', function ($req, $res) {
	$res->send('Got a PUT request at /user');
});

//DELETE
$app->delete('user', function ($req, $res) {
	$res->send('Got a DELETE request at /user');
});
```

## Route Parameters
```php
//Defines a GET route for the path "route/:username/:id"
$app->get('route/:username/:id', function ($req, $res) {
	$res->send(print_r($req->params, true));
});

//Parameter access
$username = $req->params['username'];
$id = $req->params['id'];
```

## Middleware
```php
//Apply to all routes
$app->use('*',function($req, $res) {
    $res->header('X-Service-Key', 'Example123456');
});

//Apply to specific route (home)
$app->use('/route',function($req, $res) {
    $res->header('X-Service-Key', 'Example7891011');
});
```

## Shortcode
```php
//Define shortcode
$app->shortcode('hello', function() {
    return 'world';
});

//Using shortcode
$app->get('/', function ($req, $res) {
    $content = 'PHP says Hello [hello]!';
    $res->send($content);
});
```

## Database
```php
$app->get('/database',function(Request $req, Response $res) {
	$database = $req->app->db;

    $data = Array ("name" => "Francesco",
        "createdAt" =>  $database->now(),
        "updatedAt" =>  $database->now(),
    );

    $id = $database->insert ('tableName', $data);

    $cols = Array("name");
    $data = $database->get("tableName",null, $cols);

    echo "last inserted id: $id";
    $res->send($data);
});
```

## Transient
```php
$app->get('transient', function(Request $req, Response $res){
    $cache = $req->app->cache;

    //Get transient
    $data = $cache->get('my_transient_key');

    if ($data !== false) {
        $res->send("Data from cache: " . $data);
    } else {
        echo "Cache expired or not found.";
    }

    $cache->set('my_transient_key', 'Fast Framework cached data', 3600); //valid for 1 our

    $resData = $cache->get('my_transient_key');

    // Remove transient
    $cache->delete('my_transient_key');

    $res->send($resData);
});
```

[For more information, read the documentation](https://www.francescocappa.it/fast-framework/docs/)