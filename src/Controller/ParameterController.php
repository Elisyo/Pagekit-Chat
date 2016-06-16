<?php
/**
 * Created by IntelliJ IDEA.
 * User: Flo.Resos
 * Date: 19/05/16
 * Time: 10:19
 */

namespace Pagekit\Chat\Controller;
use Pagekit\Application as App;

/**
 * @Access(admin=true)
 */
class ParameterController
{
    public function indexAction()
    {
        $module = App::module('chat');
        $config = $module ->config;
        return [
            '$view' => [
                'title' => 'Chat',
                'name' => 'chat:views/admin/parameter.php'
            ],
            '$data' => $config,
            'Port' => $config['Port'],
            'rooms' => $config['rooms']
        ];
    }
    /**
     * @Routes("/save")
     * @Request({"rooms":"array","Port":"array"},csrf=true)
     */
    public function saveAction($rooms = [], $Port = [])
    {
        App::config('chat')->set('rooms', $rooms);
        App::config('chat')->set('Port', $Port);
        return ['success' => true];
    }
}



