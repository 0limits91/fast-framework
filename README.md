[![Fast Framework Logo](https://www.francescocappa.it/fast-framework/docs/assets/logo.png)](https://www.francescocappa.it/fast-framework/)

# Fast-Framework
Fast is a fast, simple, extensible framework for PHP. Fast enables you to quickly and easily build RESTful web applications.

```php
include __DIR__ . '/../src/autoload.php';
$app = new \FastFramework\Application();

$app->get('/', function ($req, $res) {
    $res->send('Hello, World!');
});

$app->run();
```

[For more information, read the documentation](https://www.francescocappa.it/fast-framework/docs/)