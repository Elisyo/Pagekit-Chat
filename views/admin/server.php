
<?php

use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use Pagekit\Chat\Controller\ServerController;

// cd /Applications/MAMP/htdocs/MyRatchetFirstApp/
//require dirname(__DIR__) . '/../../../../app/vendor/autoload.php';
require dirname(__DIR__) . '/../vendor/autoload.php';

$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new ServerController()
        )
    ),
    8076
);

$server->run();

?>