<?php

namespace Pagekit\Chat\Controller;

use Pagekit\Application as App;
use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;

require dirname(__DIR__) . '/../../../../app/vendor/autoload.php';

/**
 * @Access(admin=true)
 */
class ServerController implements MessageComponentInterface{
    public function indexAction(){
        $module = App::module('chat');
        $config = $module -> config;
        return [
            '$view' => [
                'title' => 'Chat',
                'name' => 'chat:views/admin/server.php'
            ],
            '$data' => $config,
            'Port' => $config['Port'],
            'rooms' => $config['rooms']
        ];
    }
    protected $clients;
    public function __construct() {
        $this->clients = new \SplObjectStorage;
    }
    /**
     * @Routes(/toto)
     */
    public function totoAction() {
        return 1;
    }
    /**
     * @Routes(/send)
     */
    public function sendAction($msg) {
        if(isset($_GET["msg"])){
            $msg = $_GET["msg"];
        }
        return $msg;
    }
    /**
     * @Routes(/onOpen)
     */
    public function onOpen(ConnectionInterface $conn) {
        // Store the new connection to send messages to later
        $this->clients->attach($conn);

        echo "New connection! ({$conn->resourceId})<br/>";
        return ['success' => true];
    }
    /**
     * @Routes(/onMessage)
     */
    public function onMessage(ConnectionInterface $from, $msg) {

        foreach ($this->clients as $client) {
            $client->send($msg);
        }
        return ['success' => true];
    }
    /**
     * @Routes(/onClose)
     */
    public function onClose(ConnectionInterface $conn) {
        // The connection is closed, remove it, as we can no longer send it messages
        $this->clients->detach($conn);
        echo "Connection {$conn->resourceId} has disconnected<br/>";
    }
    /**
     * @Routes(/onError)
     */
    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}<br/>";
        $conn->close();
    }
}

