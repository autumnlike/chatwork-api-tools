<?php

require_once('./post.php');
require_once('./args.php');
require_once('./body.php');

// 引数のパラメータを取得
$args = get_args($argc, $argv);
check_args($args, array('body', 'token', 'room_id', 'to_ids'));

// Toをセット
$args['body'] = set_to_message($args['body'], $args['to_ids']);

$params = array(
    'body'   => $args['body'],
    'limit'  => $args['limit'],
    'to_ids' => $args['to_ids'],
);

post($args['room_id'], $args['token'], $params, 'tasks');
