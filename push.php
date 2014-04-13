<?php

require_once('lib/post.php');
require_once('lib/args.php');
require_once('lib/body.php');

// 引数のパラメータを取得
$args = get_args($argc, $argv);
check_args($args, array('body', 'token', 'room_id'));

if ($args['type'] == 'task') check_args($args, array('to_ids'));


$params = array(
    'body'   => $args['body'],
    'limit'  => $args['limit'],
);

if (!empty($args['to_ids'])) {
    $params['to_ids'] = $args['to_ids'];
    // to_ids 設定がある場合は、メッセージに[To:]をつける
    $params['body'] = set_to_message($args['body'], $args['to_ids']);
}

post($args['room_id'], $args['token'], $params, $args['type']);
