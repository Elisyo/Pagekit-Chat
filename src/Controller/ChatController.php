<?php

namespace Pagekit\Chat\Controller;
use Pagekit\Application as App;

class ChatController{
    public function indexAction(){
        $module = App::module('chat');
        $config = $module -> config;

        $user = App::user();

        if($user -> isAnonymous()){
            return "You have to login first";
        }
        return [
            '$view' => [
                'title' => 'Chat',
                'name' => 'chat:views/index.php'
            ],
            '$user' => $user,
            '$data' => $config,
            'rooms'=>$config['rooms'],
            'Port'=>$config['Port']
        ];
    }
    /**
     * @Routes("/rooms")
     */
    public function roomsAction()
    {
        // create query
        $query = $query = App::Babeez()->createQueryBuilder();

        // fetch title and content of all blog posts that do not have any comments
        $comments = $query
            ->select(['*'])
            ->from('@system_config')
            ->get();
    }
}


