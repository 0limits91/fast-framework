<?php
use FastFramework\Request;
use FastFramework\Response;

include __DIR__ . '/../src/autoload.php';

$app = new \FastFramework\Application();
$router = new \FastFramework\Router($app);

### MIDDLEWARE EXAMPLE ###
$router->use('*',function($req, $res) {
    $res->header('X-Service-Key', 'Example123456');
});

$router->use('/',function($req, $res) {
    $res->header('X-Service-Key', 'Example7891011');
});

### GET EXAMPLE ###
$router->get('/', function ($req, $res) {
    $res->set('Content-Type', 'application/json');
    $res->json(array(
        'hello' => 'world'
    ));
});


### POST EXAMPLE ###
$router->get('post', function ($req, $res) {
    $html = <<<EEE
            <form action="./post" method="post">
                <p>
                    <label for="says">Say</label>
                    <input readonly type="text" name="says" id="says" value="Hello World!">
                </p>
                <button type="submit">Send</button>
            </form>
            EEE;

    $res->send($html);
});

$router->post('post', function ($req, $res) {
    $res->send('<a href="../">&laquo; Back</a><pre>'.print_r($_POST, true));
});


### REDIRECT EXAMPLE ###
$router->get('redirect', function ($req, $res) {
    $res->redirect('https://google.com');
});

### CONTROLLER EXAMPLE ###
$router->get('controller', '\controllers\example#home');
$router->get('info.html', '\controllers\example#info');


$router->get('params', function ($req, $res) {
    $link = 'Francesco/says/Hello!';
    $res->send('<p>Pattern => :name/:action/:text</p> <p>Link: <a href="'.$link.'">'.$link.'</a></p>');
});

$router->get(':name/:action/:text', function ($req, $res) {
    $res->send('<a href="../../../">&laquo; Back</a><pre>'.print_r($req->params, true));
});


### SHORTCODES/JS EXAMPLE ###
$router->shortcode('shortcode', function() {
    return '<div id="sayHello"> error </div>';
});

$router->shortcode('hello', function() {
    return 'world';
});

$router->get('shortcode', function ($req, $res) {
    $content = "<a href='../'>&laquo; Back</a><br/>PHP says Hello [hello]! <br/> [shortcode]";

    $res->enqueueScript('test-script', 'js/test.js');
    $res->localizeScript('test-script', 'variableSayHello', "Hello World!");
   
    $res->send($content);
});


$router->get('database', function(Request $req, Response $res){
    $database = $req->app->db;
    
    $data = Array ("name" => "Francesco",
        "createdAt" =>  $database->now(),
        "updatedAt" =>  $database->now(),
    );
    
    $id = $database->insert ('test', $data);

    $cols = Array("name");
    $data = $database->get("test",null, $cols);

    array_push($data, Array("lastInsertedId" => $id));
    $res->send($data);
});

//Application Start
$router->run();