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
    $args = array();
    if ( $argc > 0 ) {
        foreach( $argv as $strArg ){
            if ( ( $arrTmp = explode('==', $strArg) ) && count($arrTmp) > 1 ) {
                $args[$arrTmp[0]] = $arrTmp[1];
            }
        }
    }
    // 期限はデフォルト当日
    $args['limit'] = empty($args['limit']) ? time() : strtotime($args['limit']);

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
    var_export($args);

    // 必要パラメータ確認
    foreach ($requiredArgs as $key) {
        var_dump($key);
        if (empty($args[$key])) $success = false;
    }
    if ($success == false) {
        echo "引数が不正なため処理を停止しました\n";
        echo "ex) php put_task.php token==TOKEN room_id==ROOM_ID to_ids==ID_1,ID_2,ID_3 limit=Y-m-d body==本文\n";
        exit;
    }
}
