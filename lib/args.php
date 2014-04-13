<?php

/**
 * コマンドライン引数を args => value の形で配列に入れる
 *
 * @param int $argc
 * @param array $argv
 * @return array
 * @access public
 */
function get_args($argc, $argv) {
    $argNames = array(
        'token',
        'room_id',
        'body',
        'type',
        'to_ids',
        'limit',
    );

    $args = array();
    if ( $argc > 0 ) {
        foreach( $argv as $strArg ){
            foreach ($argNames as $names) {
                if (preg_match("/^({$names}=)/", $strArg)) {
                    $args[$names] = preg_replace("/^({$names}=)/", '', $strArg);
                }
            }
        }
    }
    // 期限はデフォルト当日
    $args['limit'] = empty($args['limit']) ? time() : strtotime($args['limit']);

    // typeはデフォルトmessages
    $args['type'] = empty($args['type']) ? 'messages' : $args['type'];
    check_type($args['type']);

    return $args;
}

/**
 * 引数を確認
 *
 * 引数が足りなければ、処理を停止する
 *
 * @param array $args
 * @param array $requireArgs
 * @access public
 * @return void
 */
function check_args($args, $requiredArgs = array('token')) {
    $success = true;
    if (empty($args)) $success = false;

    // 必要パラメータ確認
    foreach ($requiredArgs as $key) {
        if (empty($args[$key])) $success = false;
    }
    if ($success == false) {
        var_export($args);
        echo "引数が不正なため処理を停止しました\n";
        echo "ex) php put_task.php token=TOKEN room_id=ROOM_ID to_ids=ID_1,ID_2,ID_3 limit=Y-m-d type=messages body=本文\n";
        exit;
    }
}

function check_type($type) {
    if (!in_array($type, array('messages', 'tasks'))) {
        echo "引数が不正なため処理を停止しました\n";
        echo "type は messages か tasks のみ可能です。\n";
        exit;
    }
    return true;
}
