<?

// 引数を args => value の形で配列に入れる
if ( $argc > 0 ) {
    foreach( $argv as $strArg ){
        if ( ( $arrTmp = explode('==', $strArg) ) && count($arrTmp) > 1 ) {
            $args[$arrTmp[0]] = $arrTmp[1];
        }
    }
}

// 必要パラメータ確認
if ($argc < 1
    || empty($args)
    || empty($args['body'])
    || empty($args['token'])
    || empty($args['room_id'])
    || empty($args['to_ids'])
) {
    echo "引数が不正なため処理を停止しました\n";
    echo "ex) php put_task.php token==TOKEN room_id==ROOM_ID to_ids==ID_1,ID_2,ID_3 limit=Y-m-d body==本文\n";
    exit;
}

unset($argv[0]);

// 期限
$limit = empty($args['limit']) ? time() : strtotime($args['limit']);

// タスクにするID
$userIds = $args['to_ids'];

// 文面
$body = $args['body'];

// token
$token = $args['token'];

// room_id
$roomId = $args['room_id'];

// To設定
if (!empty($args['to_ids'])) {
    $to = null;
    foreach (preg_split('/,/', $args['to_ids']) as $id) {
        $to .= "[To:{$id}]";
    }
    $body = $to . "\n\n" . $body;
}

$params = array(
    'body'   => $body,
    'limit'  => $limit,
    'to_ids' => $userIds,
);

$url = "https://api.chatwork.com/v1/rooms/{$roomId}/tasks";

$headers = array(
    'X-ChatWorkToken:' . $token,
    "Content-Type: application/x-www-form-urlencoded",
    "Content-Length: " . strlen(http_build_query($params))
);
$options = array('http' => array(
    'method' => 'POST',
    'content' => http_build_query($params),
    'header' => implode("\r\n", $headers),
));

if (!$contents = file_get_contents($url, false, stream_context_create($options))) {
    echo "処理失敗しました\n";
}
